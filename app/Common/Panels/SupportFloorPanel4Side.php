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

class SupportFloorPanel4Side {

    protected $waterline_height;
    protected $viewing_width;
    protected $viewing_length;
    protected $final_cost_formula;
    protected $tReference;
    protected $supportPanel4Side;
    protected $panelSetting;
    protected $caseOneFirstEquationFormula;
    protected $caseOneSecondEquationFormula;
    protected $id;

    function __construct($request, $id) {

        /**
         * validation process
         */
        $rules = [
            'waterline_height' => 'required|numeric',
            'viewing_width' => 'required|numeric',
            'viewing_length' => 'required|numeric',
        ];
        
        $validator = Validator::make(Input::all(), $rules)->validate();
        
        /**
         * class global variable assignment
         */
        $this->tReference = \App::make(TReferenceTableRepositoryInterface::class);
        $this->t2dReference = \App::make(T2dReferenceTableRepositoryInterface::class);
        $this->supportPanel4Side = \App::make(SupportPanel4sideRepositoryInterface::class);
        $this->panelSetting = \App::make(PanelSettingRepositoryInterface::class);
        $this->waterline_height = $request->waterline_height;
        $this->viewing_width = $request->viewing_width;
        $this->viewing_length = $request->viewing_length;
        $this->id = $id;

        /**
         * formula's used by this class to get the value of T
         */
        $this->caseOneFirstEquationFormula = ['formula' => '((c*(0.0361*w)(b*b*b*b))/400000)/(b/300)', 'isCubeRoot' => true, 'isRoot' => false];
        $this->caseOneSecondEquationFormula = ['formula' => '(B*(0.0361*w)(b*b))/800', 'isCubeRoot' => false, 'isRoot' => true];
        
        /**
         * final cost calculation furmula
         */
        $this->final_cost_formula = '(T*(a+(2*J))*(b+(2*J))*M)+((a+(2*J))*(b+(2*J))*S)';
    }

    /**
     * execute all formula's and get the final calculated cost of panel
     * @return type float
     */
    public function calculateCost() {
        $temp = 0;
        
        if($this->viewing_width > $this->viewing_length) { 
            $temp = $this->viewing_length;
            $this->viewing_length = $this->viewing_width;
            $this->viewing_width = $temp;
        }
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
            $search = array("J","M", "S","T","a","b");
            if( $T > $settings['J']){
                $settings['J'] = $T;
            }
            $settings['T'] = (Float)$T;
            $settings['a'] = (Float)$this->viewing_length;
            $settings['b'] = (Float)$this->viewing_width;
            
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
        $t2d = $this->viewing_length / $this->viewing_width; //(a/b)
        $t2d = round($t2d,3);
        return $this->supportPanel4Side->get2dReferenceValueOfT($t2d);
    }
    
    /**
     * check condition
     * @return type
     */
    public function getValueOfT() {
        
        return $res = $this->resolveCaseOne();
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
     * resolve case eqations
     * @return type
     */
    public function resolveCaseOneFirstEquation() {
        $data2d = $this->get2dValue();
        $search = array('w', 'b','c');
        $niddle = array($this->waterline_height,$this->viewing_width,$data2d->ref_value_cu);
        $equation = $this->simplifyEquation($search, $niddle, $this->caseOneFirstEquationFormula['formula']);
        
        return $this->solveEquation($equation, $this->caseOneFirstEquationFormula['isCubeRoot'], $this->caseOneFirstEquationFormula['isRoot']);
    }

    /**
     * resolve case eqations
     * @return type
     */
    public function resolveCaseOneSecondEquation() {
        $data2d = $this->get2dValue();
        $search = array('B', 'b','w');
        $niddle = array($data2d->ref_value_bu,$this->viewing_width,$this->waterline_height);
        $equation = $this->simplifyEquation($search, $niddle, $this->caseOneSecondEquationFormula['formula']);
        
        return $this->solveEquation($equation, $this->caseOneSecondEquationFormula['isCubeRoot'], $this->caseOneSecondEquationFormula['isRoot']);
    }
    
}
