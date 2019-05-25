<?php

namespace App\Common\Panels;

use jlawrence\eos\Parser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Common\Repositories\Base\TReferenceTableRepositoryInterface;
use App\Common\Repositories\Base\PanelSettingRepositoryInterface;

class CircleHorizontalPanel {
    
    /**
     *
     * @var type requiest params (input by user)
     */
    protected $waterline_height;
    protected $visible_diameter;
    
    /**
     *
     * @var variable declaration for internal use
     */
    protected $final_cost_formula;
    protected $tReference;
    protected $panelSetting;
    protected $caseOneFirstEquationFormula;
    protected $caseOneSecondEquationFormula;
    
    protected $id;

    function __construct($request, $id) {

        /**
         * validation process
         */
        $rules = [
            'waterline_height'=>'required|numeric',
            'visible_diameter'=>'required|numeric'
        ];

        $validator = Validator::make(Input::all(), $rules)->validate();

        /**
         * class global variable assignment
         */
        $this->tReference = \App::make(TReferenceTableRepositoryInterface::class);
        $this->panelSetting = \App::make(PanelSettingRepositoryInterface::class);
        $this->waterline_height = $request->waterline_height;
        $this->visible_diameter = $request->visible_diameter;
        $this->id = $id;

        /**
         * formula's used by this class to get the value of T
         */
        $this->caseOneFirstEquationFormula = ['formula' => '((0.0444(0.0361*w)*(D*D*D*D))/400000)/(D/300)', 'isCubeRoot' => true, 'isRoot' => false];
        $this->caseOneSecondEquationFormula = ['formula' => '(0.2874(0.0361*w)*(w*w)/800)', 'isCubeRoot' => false, 'isRoot' => true];

        /**
         * final cot calculation furmula
         */
        $this->final_cost_formula = '((T(3.14((.5*D+J)^2)))*M) + ((3.14((.5*D+J)^2))*S)';
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
        
        if ($settings) {
            $settings = json_decode($settings->setting, true);
            unset($settings['I1'], $settings['I2'], $settings['I3'], $settings['I4']);
            $search = array("J", "M", "S", "T","D");
            
            if($T > $settings['J']){
                $settings['J'] = $T;
            }
            $settings['T'] = round($T, 3);
            $settings['D'] = $this->visible_diameter;
            $equation = $this->simplifyEquation($search, $settings, $this->final_cost_formula);
            return $this->solveEquation($equation);
        }
        \App::abort(404,'Admin settings not found');
    }

    /**
     * get panel settings managed by admin
     * @return type mixed array
     */
    public function getPanelSettings() {
        return $this->panelSetting->findBy(['panel_id'=>$this->id]);
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
     * case one formula
     * @return type
     */
    public function getValueOfT() {
        $t1 = $this->resolveFirstEquation();
        $t2 = $this->resolveSecondEquation();

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
    public function resolveFirstEquation() {
        $search = array('w', 'D');
        $niddle = array($this->waterline_height, $this->visible_diameter);

        $equation = $this->simplifyEquation($search, $niddle, $this->caseOneFirstEquationFormula['formula']);
        return $this->solveEquation($equation, $this->caseOneFirstEquationFormula['isCubeRoot'], $this->caseOneFirstEquationFormula['isRoot']);
    }

    /**
     * resolve case eqations
     * @return type
     */
    public function resolveSecondEquation() {
        
        $equation = $this->simplifyEquation('w', $this->waterline_height, $this->caseOneSecondEquationFormula['formula']);
        return $this->solveEquation($equation, $this->caseOneSecondEquationFormula['isCubeRoot'], $this->caseOneSecondEquationFormula['isRoot']);
    }
}

