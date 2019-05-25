<?php

namespace App\Common\Panels;

use jlawrence\eos\Parser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Common\Repositories\Base\TReferenceTableRepositoryInterface;
use App\Common\Repositories\Base\T2dReferenceTableRepositoryInterface;
use App\Common\Repositories\Base\PanelSettingRepositoryInterface;

class SupportPanel3Side {

    protected $waterline_height;
    protected $viewing_height;
    protected $viewing_length;
    protected $final_cost_formula;
    protected $tReference;
    protected $t2dReference;
    protected $panelSetting;
    protected $caseOneFirstEquationFormula;
    protected $caseOneSecondEquationFormula;
    protected $caseTwoFirstEquationFormula;
    protected $caseTwoSecondEquationFormula;
    protected $id;

    function __construct($request, $id) {

        /**
         * validation process
         */
        $rules = [
            'waterline_height' => 'required|numeric',
            'viewing_height' => 'required|greater_than:waterline_height|numeric',
            'viewing_length' => 'required|numeric',
        ];

        $validator = Validator::make(Input::all(), $rules)->validate();

        /**
         * class global variable assignment
         */
        $this->tReference = \App::make(TReferenceTableRepositoryInterface::class);
        $this->t2dReference = \App::make(T2dReferenceTableRepositoryInterface::class);
        $this->panelSetting = \App::make(PanelSettingRepositoryInterface::class);
        $this->waterline_height = $request->waterline_height;
        $this->viewing_height = $request->viewing_height;
        $this->viewing_length = $request->viewing_length;
        $this->id = $id;

        /**
         * formula's used by this class to get the value of T
         */
        $this->caseOneFirstEquationFormula = ['formula' => '12*(((0.0361*w)*(l*l*l*l)/6000000)/((0.005*h)*(w/h)))', 'isCubeRoot' => true, 'isRoot' => false];
        $this->caseOneSecondEquationFormula = ['formula' => '((0.0361*w)*(l*l)/800)', 'isCubeRoot' => false, 'isRoot' => true];
        $this->caseTwoFirstEquationFormula = ['formula' => 'c*(0.0361*w)*(l*l*l*l)/200000/(0.0025*l)*(w/h)', 'isCubeRoot' => true, 'isRoot' => false];
        $this->caseTwoSecondEquationFormula = ['formula' => '(b*(0.0361*w)*(l*l)/800)', 'isCubeRoot' => false, 'isRoot' => true];

        /**
         * final cot calculation furmula
         */
        $this->final_cost_formula = '(B*L)+((T)*(L+(2*J))*(h+(3*T))*(M))+((L+(2*J))*(h+(3*T))*(S))';
    }

    /**
     * execute all formula's and get the final calculated cost of panel
     * @return type float
     */
    public function calculateCost() {
        $T = $this->getValueOfT();
        $T = $this->getReferenceValueOfT($T);
        return $this->resolveFinalCostFormula($T);
    }

    /**
     * solve the mathematical equation
     * @param type mixed $equation
     * @param type boolean $isCubeRoot
     * @param type boolean $isRoot
     * @return type mixed
     */
    public function solveEquation($equation, $isCubeRoot = false, $isRoot = false) {
        
        $value = Parser::solve($equation);
        
        if ($isCubeRoot) {
            $value = pow("$value", 1 / 3);
        }
        if ($isRoot) {
            $value = sqrt($value);
        }

        return round($value,3);
    }

    /**
     * simplify a eqation by fins and replace placeholders 
     * @param type $search
     * @param type $niddle
     * @param type $equation
     * @return type string
     */
    public function simplifyEquation($search = array(), $niddle = array(), $equation) {
        return str_replace($search, $niddle, $equation);
    }

    /**
     * resolve final cost formula
     * @param type $T
     * @return type
     */
    public function resolveFinalCostFormula($T) {
        
        $settings = $this->getPanelSettings();
        $T = round($T, 3);
        if ($settings) {
            $settings = json_decode($settings->setting, true);
            unset($settings['I1'], $settings['I2'], $settings['I3'], $settings['I4']);
            $search = array("J", "B", "M", "S", "T", "L", "h");
            if( $T > $settings['J']){
                $settings['J'] = $T;
            }
            $settings['T'] = $T;
            $settings['L'] = $this->viewing_length;
            $settings['h'] = $this->viewing_height;
            $equation = $this->simplifyEquation($search, $settings, $this->final_cost_formula);
            
            return $this->solveEquation($equation);
        }
        \App::abort('Admin settings not found', 404);
    }

    /**
     * get panel settings managed by admin
     * @return type mixed array
     */
    public function getPanelSettings() {
        return $this->panelSetting->find($this->id);
    }

    /**
     * get reference value of T from common T reference table
     * @param type $T
     * @return type
     */
    public function getReferenceValueOfT($T) {
        return $this->tReference->getReferenceValueOfT($T);
    }

    /**
     * check condition
     * @return type
     */
    public function getValueOfT() {

        if (($this->viewing_length >= 2 * $this->waterline_height)) {
            
            return $res = $this->resolveCaseOne();
        } else {
            
            return $res = $this->resolveCaseTwo();
        }
    }

    /**
     * case one formula
     * @return type
     */
    public function resolveCaseOne() {
        $t1 = $this->resolveCaseOneFirstEquation();
        $t2 = $this->resolveCaseOneSecondEquation();

        if ($t1 > $t2) {
            return $t1;
        } else {
            return $t2;
        }
    }

    /**
     * case two formula
     * @return type
     */
    public function resolveCaseTwo() {
        $t1 = $this->resolveCaseTwoFirstEquation();
        
        $t2 = $this->resolveCaseTwoSecondEquation();
        
        if ($t1 > $t2) {
            return $t1;
        } else {
            return $t2;
        }
    }
    
    /**
     * Get the value for 2d
     * @return type
     */
    public function get2dValue() {
        $t2d = $this->waterline_height / $this->viewing_length;
        return $this->t2dReference->get2dReferenceValueOfT($t2d);
    }

        /**
     * resolve case eqations
     * @return type
     */
    public function resolveCaseOneFirstEquation() {
        $search = array('h', 'w','l');
        $niddle = array($this->viewing_height, $this->waterline_height,$this->viewing_length);

        $equation = $this->simplifyEquation($search, $niddle, $this->caseOneFirstEquationFormula['formula']);
        
        return $this->solveEquation($equation, $this->caseOneFirstEquationFormula['isCubeRoot'], $this->caseOneFirstEquationFormula['isRoot']);
    }

    /**
     * resolve case eqations
     * @return type
     */
    public function resolveCaseOneSecondEquation() {
        $search = array('w','l');
        $niddle = array($this->waterline_height,$this->viewing_length);
        $equation = $this->simplifyEquation($search, $niddle, $this->caseOneSecondEquationFormula['formula']);
        
        return $this->solveEquation($equation, $this->caseOneSecondEquationFormula['isCubeRoot'], $this->caseOneSecondEquationFormula['isRoot']);
    }

    /**
     * resolve case eqations
     * @return type
     */
    public function resolveCaseTwoFirstEquation() {
        $data2d = $this->get2dValue();
        
        $search = array('h', 'w','c','l');
        $niddle = array($this->viewing_height, $this->waterline_height,$data2d->ref_value_c,$this->viewing_length);
        
        $equation = $this->simplifyEquation($search, $niddle, $this->caseTwoFirstEquationFormula);
        
        return $this->solveEquation($equation['formula'], $this->caseTwoFirstEquationFormula['isCubeRoot'], $this->caseTwoFirstEquationFormula['isRoot']);
    }

    /**
     * resolve case eqations
     * @return type
     */
    public function resolveCaseTwoSecondEquation() {
        $data2d = $this->get2dValue();
        
        $search = array('w','b','l');
        $niddle = array($this->waterline_height,$data2d->ref_value_b,$this->viewing_length);
        $equation = $this->simplifyEquation($search, $niddle, $this->caseTwoSecondEquationFormula);
        
        return $this->solveEquation($equation['formula'], $this->caseTwoSecondEquationFormula['isCubeRoot'], $this->caseTwoSecondEquationFormula['isRoot']);
    }

}
