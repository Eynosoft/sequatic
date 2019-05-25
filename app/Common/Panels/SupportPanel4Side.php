<?php

namespace App\Common\Panels;

use jlawrence\eos\Parser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Common\Repositories\Base\TReferenceTableRepositoryInterface;
use App\Common\Repositories\Base\T2dReferenceTableRepositoryInterface;
use App\Common\Repositories\Base\SupportPanel4sideRepositoryInterface;
use App\Common\Repositories\Base\SupportPanelA4sideRepositoryInterface;
use App\Common\Repositories\Base\SupportPanelB4sideRepositoryInterface;
use App\Common\Repositories\Base\PanelSettingRepositoryInterface;

class SupportPanel4Side {

    protected $waterline_height;
    protected $viewing_height;
    protected $viewing_length;
    protected $final_cost_formula;
    protected $tReference;
    protected $t2dReference;
    protected $supportPanel4Side;
    protected $supportPanelA4Side;
    protected $supportPanelB4Side;
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
            'viewing_height' => 'required|numeric',
            'viewing_length' => 'required|numeric',
        ];
        
        $validator = Validator::make(Input::all(), $rules)->validate();
        
        /**
         * class global variable assignment
         */
        $this->tReference = \App::make(TReferenceTableRepositoryInterface::class);
        $this->t2dReference = \App::make(T2dReferenceTableRepositoryInterface::class);
        $this->supportPanel4Side = \App::make(SupportPanel4sideRepositoryInterface::class);
        $this->supportPanelA4Side = \App::make(SupportPanelA4sideRepositoryInterface::class);
        $this->supportPanelB4Side = \App::make(SupportPanelB4sideRepositoryInterface::class);
        $this->panelSetting = \App::make(PanelSettingRepositoryInterface::class);
        $this->waterline_height = $request->waterline_height;
        $this->viewing_height = $request->viewing_height;
        $this->viewing_length = $request->viewing_length;
        $this->id = $id;

        /**
         * formula's used by this class to get the value of T
         */
        $this->caseOneFirstEquationFormula = ['formula' => '(((c1*(0.0361*(w-b))*(b*b*b*b))/400000)/(b/300)) + (((c*(0.0361*b)*(b*b*b*b))/400000)/(b/300))', 'isCubeRoot' => true, 'isRoot' => false];
        $this->caseOneSecondEquationFormula = ['formula' => '((b1*(0.0361*(w-b))*(b*b))/800) + ((b2*(0.0361*b)*(b*b))/800)', 'isCubeRoot' => false, 'isRoot' => true];
        $this->caseTwoFirstEquationFormula = ['formula' => '(((c1*(0.0361*(w-b))*(a*a*a*a))/400000)/(a/300)) + (((c*(0.0361*b)*(a*a*a*a))/400000)/(a/300))', 'isCubeRoot' => true, 'isRoot' => false];
        $this->caseTwoSecondEquationFormula = ['formula' => '((b1*(0.0361*(w-b))*(a*a))/800) + ((b2*(0.0361*b)*(a*a))/800)', 'isCubeRoot' => false, 'isRoot' => true];
        
        /**
         * final cost calculation furmula
         */
        $this->final_cost_formula = '((T)*(a+(2*J))*(b+(2*J))*(M))+((a+(2*J))*(b+(2*J))*(S))';
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
            $search = array("J", "B", "M", "S","T","a","b");
            if( $T > $settings['J']){
                $settings['J'] = $T;
            }
            $settings['T'] = (Float)$T;
            $settings['a'] = (Float)$this->viewing_length;
            $settings['b'] = (Float)$this->viewing_height;
            
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
        return $this->panelSetting->findBy([['panel_id', '=', $this->id]]);
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
     * Get the value for supportPanel4side
     * @return type
     */
    public function get2dValue() {
        $t2d = $this->viewing_length/$this->viewing_height;
        $t2d = round($t2d,3);
        return $this->supportPanel4Side->get2dReferenceValueOfT($t2d);
    }
    /**
     * Get the value for supportPanelA4side
     * @return type
     */
    public function getAValue() {
        $t2d = $this->viewing_length/$this->viewing_height;
        $t2d = round($t2d,3);
        return $this->supportPanelA4Side->get2dReferenceValueOfT($t2d);
    }
    /**
     * Get the value for supportPanelB4side
     * @return type
     */
    public function getBValue() {
        $t2d = $this->viewing_height/$this->viewing_length;
        $t2d = round($t2d,3);
        return $this->supportPanelB4Side->get2dReferenceValueOfT($t2d);
    }
    /**
     * check condition
     * @return type
     */
    public function getValueOfT() {
        
        if (($this->viewing_length >= $this->viewing_height)) {
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
     * resolve case eqations
     * @return type
     */
    public function resolveCaseOneFirstEquation() {
        $data2d = $this->get2dValue();
        
        $dataA = $this->getAValue();
        
        $search = array('w', 'b','c1','c');
        $niddle = array($this->waterline_height,$this->viewing_height,$data2d->ref_value_cu,$dataA->ref_value_c);

        $equation = $this->simplifyEquation($search, $niddle, $this->caseOneFirstEquationFormula['formula']);
        return $this->solveEquation($equation['formula'], $this->caseOneFirstEquationFormula['isCubeRoot'], $this->caseOneFirstEquationFormula['isRoot']);
    }

    /**
     * resolve case eqations
     * @return type
     */
    public function resolveCaseOneSecondEquation() {
        $data2d = $this->get2dValue();
        
        $dataA = $this->getAValue();
        
        $search = array('w', 'b','b1','b2');
        $niddle = array($this->waterline_height,$this->viewing_height,$data2d->ref_value_bu,$dataA->ref_value_b);
        $equation = $this->simplifyEquation('w', $this->waterline_height, $this->caseOneSecondEquationFormula['formula']);
        return $this->solveEquation($equation['formula'], $this->caseOneSecondEquationFormula['isCubeRoot'], $this->caseOneSecondEquationFormula['isRoot']);
    }

    /**
     * resolve case eqations
     * @return type
     */
    public function resolveCaseTwoFirstEquation() {
        $data2d = $this->get2dValue();
        
        $dataB = $this->getBValue();
        
        $search = array('c1', 'w','b','a','c');
        $niddle = array($data2d->ref_value_cu,$this->waterline_height,$this->viewing_height,$this->viewing_length,$dataB->ref_value_c);
        
        $equation = $this->simplifyEquation($search, $niddle, $this->caseTwoFirstEquationFormula);
        
        return $this->solveEquation($equation['formula'], $this->caseTwoFirstEquationFormula['isCubeRoot'], $this->caseTwoFirstEquationFormula['isRoot']);
    }

    /**
     * resolve case eqations
     * @return type
     */
    public function resolveCaseTwoSecondEquation() {
        $data2d = $this->get2dValue();
        $dataB = $this->getBValue();
        $search = array('b1','w','b','b2','a');
        $niddle = array($data2d->ref_value_bu,$this->waterline_height,$this->viewing_height,$dataB->ref_value_b,$this->viewing_length);
        $equation = $this->simplifyEquation($search, $niddle, $this->caseTwoSecondEquationFormula);
        
        return $this->solveEquation($equation['formula'], $this->caseTwoSecondEquationFormula['isCubeRoot'], $this->caseTwoSecondEquationFormula['isRoot']);
    }
}
