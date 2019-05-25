<?php

namespace App\Common\Panels;

use jlawrence\eos\Parser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Common\Repositories\Base\TReferenceTableRepositoryInterface;
//use App\Common\Repositories\Base\T2dReferenceTableRepositoryInterface;
use App\Common\Repositories\Base\SupportPanel4sideRepositoryInterface;
use App\Common\Repositories\Base\SupportPanelA4sideRepositoryInterface;
use App\Common\Repositories\Base\SupportPanelB4sideRepositoryInterface;
use App\Common\Repositories\Base\PanelSettingRepositoryInterface;

class UShapePanel4Side {

    protected $waterline_height;
    protected $viewing_height;
    protected $viewing_length;
    protected $viewing_width_1;
    protected $viewing_width_2;
    protected $final_cost_formula;
    protected $tReference;
    protected $supportPanel4Side;
    protected $supportPanelA4Side;
    protected $supportPanelB4Side;
    protected $panelSetting;
    protected $caseOneFirstEquationFormula;
    protected $caseOneSecondEquationFormula;
    protected $caseTwoFirstEquationFormula;
    protected $caseTwoSecondEquationFormula;
    protected $caseThreeFirstEquationFormula;
    protected $caseThreeSecondEquationFormula;
    protected $caseFourthFirstEquationFormula;
    protected $caseFourthSecondEquationFormula;
    protected $caseFifthFirstEquationFormula;
    protected $caseFifthSecondEquationFormula;
    protected $caseSixthFirstEquationFormula;
    protected $caseSixthSecondEquationFormula;
    protected $id;

    function __construct($request, $id) {

        /**
         * validation process
         */
        $rules = [
            'waterline_height' => 'required|numeric',
            'viewing_height' => 'required|numeric',
            'viewing_length' => 'required|numeric',
            'viewing_width_1' => 'required|numeric',
            'viewing_width_2' => 'required|numeric',
        ];
        
        $validator = Validator::make(Input::all(), $rules)->validate();
        
        /**
         * class global variable assignment
         */
        $this->tReference = \App::make(TReferenceTableRepositoryInterface::class);
        $this->supportPanel4Side = \App::make(SupportPanel4sideRepositoryInterface::class);
        $this->supportPanelA4Side = \App::make(SupportPanelA4sideRepositoryInterface::class);
        $this->supportPanelB4Side = \App::make(SupportPanelB4sideRepositoryInterface::class);
        $this->panelSetting = \App::make(PanelSettingRepositoryInterface::class);
        $this->waterline_height = $request->waterline_height;
        $this->viewing_height = $request->viewing_height;
        $this->viewing_length = $request->viewing_length;
        $this->viewing_width_1 = $request->viewing_width_1;
        $this->viewing_width_2 = $request->viewing_width_2;
        $this->id = $id;

        /**
         * formula's used by this class to get the value of T
         */
        $this->caseOneFirstEquationFormula     = ['formula' => '(((CU*(0.0361*(w-b))*(b*b*b*b))/400000)/(b/300)) + (((c*(0.0361*b)*(b*b*b*b))/400000)/(b/300))', 'isCubeRoot' => true, 'isRoot' => false];
        $this->caseOneSecondEquationFormula    = ['formula' => '((BU*(0.0361*(w-b))*(b*b))/800) + ((B*(0.0361*b)*(b*b))/800)', 'isCubeRoot' => false, 'isRoot' => true];
        $this->caseTwoFirstEquationFormula     = ['formula' => '(((CU*(0.0361*(w-b))*(a*a*a*a))/400000)/(a/300)) + (((c*(0.0361*b)*(a*a*a*a))/400000)/(a/300))', 'isCubeRoot' => true, 'isRoot' => false];
        $this->caseTwoSecondEquationFormula    = ['formula' => '((BU*(0.0361*(w-b))*(a*a))/800) + ((B*(0.0361*b)*(a*a))/800)', 'isCubeRoot' => false, 'isRoot' => true];
        $this->caseThreeFirstEquationFormula   = ['formula' => '(((CU*(0.0361*(w-b))*(b*b*b*b))/400000)/(b/300)) + (((c*(0.0361*b)*(b*b*b*b))/400000)/(b/300))', 'isCubeRoot' => true, 'isRoot' => false];
        $this->caseThreeSecondEquationFormula  = ['formula' => '((BU*(0.0361*(w-b))*(b*b))/800) + ((B*(0.0361*b)*(b*b))/800)', 'isCubeRoot' => false, 'isRoot' => true];
        $this->caseFourthFirstEquationFormula  = ['formula' => '(((CU*(0.0361*(w-b))*(f*f*f*f))/400000)/(f/300)) + (((c*(0.0361*b)*(f*f*f*f))/400000)/(f/300))', 'isCubeRoot' => true, 'isRoot' => false];
        $this->caseFourthSecondEquationFormula = ['formula' => '((BU*(0.0361*(w-b))*(f*f))/800) + ((B*(0.0361*b)*(f*f))/800)', 'isCubeRoot' => false, 'isRoot' => true];
        $this->caseFifthFirstEquationFormula   = ['formula' => '(((CU*(0.0361*(w-b))*(b*b*b*b))/400000)/(b/300)) + (((c*(0.0361*b)*(b*b*b*b))/400000)/(b/300))', 'isCubeRoot' => true, 'isRoot' => false];
        $this->caseFifthSecondEquationFormula  = ['formula' => '((BU*(0.0361*(w-b))*(b*b))/800) + ((B*(0.0361*b)*(b*b))/800)', 'isCubeRoot' => false, 'isRoot' => true];
        $this->caseSixthFirstEquationFormula   = ['formula' => '(((CU*(0.0361*(w-b))*(f*f*f*f))/400000)/(f/300)) + (((c*(0.0361*b)*(f*f*f*f))/400000)/(f/300))', 'isCubeRoot' => true, 'isRoot' => false];
        $this->caseSixthSecondEquationFormula  = ['formula' => '((BU*(0.0361*(w-b))*(f*f))/800) + ((B*(0.0361*b)*(f*f))/800)', 'isCubeRoot' => false, 'isRoot' => true];
        /**
         * final cost calculation furmula
         */
        $this->final_cost_formula = '(T*a*(b+(2*J))*M)+(a*(b+(2*J))*S)+(X*((2*b)+(2*J)))+(T*(F+J)*(b+(2*J))*M)+((F+J)*(b+(2*J))*S)+(T*(Y+J)*(b+(2*J))*M)+((Y+J)*(b+(2*J))*S)';
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
            $search = array("J","M", "S", "X","T","a","b","F","Y");
            if( $T > $settings['J']){
                $settings['J'] = $T;
            }
            $settings['T'] = (Float)$T;
            $settings['a'] = (Float)$this->viewing_length;
            $settings['b'] = (Float)$this->viewing_height;
            $settings['F'] = (Float)$this->viewing_width_1;
            $settings['Y'] = (Float)$this->viewing_width_2;
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
     * Get the value for 2d
     * @return type
     */
    public function get2dValue($delta) {
        if($delta == 'delta_b') {
            $t2d = $this->viewing_height / $this->viewing_length;   //(b/a)
        } elseif ($delta == 'delta_f') {
            $t2d = $this->viewing_width_1 / $this->viewing_height;   //(f/b)
        } elseif ($delta == 'delta_bf') {
            $t2d = $this->viewing_height / $this->viewing_width_1;   //(b/f)
        } elseif ($delta == 'delta_yb') {
            $t2d = $this->viewing_width_2 / $this->viewing_height;   //(y/b)
        } elseif ($delta == 'delta_by') {
            $t2d = $this->viewing_height / $this->viewing_width_2;   //(b/y)
        } else {
            $t2d = $this->viewing_length / $this->viewing_height;   //(a/b)
        }
        
        $t2d = round($t2d,3);
        return $this->supportPanel4Side->get2dReferenceValueOfT($t2d);
    }
    
    /**
     * Get the value for supportPanelA4side
     * @return type
     */
    public function getAValue($delta) {
        if($delta == 'delta_f') {
            $t2d = $this->viewing_width_1/$this->viewing_height;             //(f/b)
        } elseif ($delta == 'delta_yb') {
            $t2d = $this->viewing_width_2 / $this->viewing_height;           //(y/b)
        } else {
            $t2d = $this->viewing_length/$this->viewing_height;             //(a/b)
        }
        
        $t2d = round($t2d,3);
        return $this->supportPanelA4Side->get2dReferenceValueOfT($t2d);
    }
    /**
     * Get the value for supportPanelB4side
     * @return type
     */
    public function getBValue($delta) {
        if( $delta == 'delta_bf') {
            $t2d = $this->viewing_height/$this->viewing_width_1;             //(b/f)
        } elseif ($delta == 'delta_by') {
            $t2d = $this->viewing_height/$this->viewing_width_2;             //(b/y)
        } else {
            $t2d = $this->viewing_height/$this->viewing_length;             //(b/a)
        }
        
        $t2d = round($t2d,3);
        return $this->supportPanelB4Side->get2dReferenceValueOfT($t2d);
    }

    /**
     * check condition
     * @return type
     */
    public function getValueOfT() {
        
        if (($this->viewing_length >= $this->viewing_height)) {             //(a>=b)
            
            return $res = $this->resolveCaseOne();
        } elseif (($this->viewing_length < $this->viewing_height)) {        //(a<b)
            
            return $res = $this->resolveCaseTwo();
        } elseif (($this->viewing_width_1 >= $this->viewing_height)) {      //(f>=b)
            
            return $res = $this->resolveCaseThree();
        } elseif (($this->viewing_width_1 < $this->viewing_height)) {       //(f<b)
            
            return $res = $this->resolveCaseFourth();
        } elseif (($this->viewing_width_2 >= $this->viewing_height)) {      //(y>=b)
            
            return $res = $this->resolveCaseFifth();
        }else {
            
            return $res = $this->resolveCaseSixth();                        //(y<b)                
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
     * case two formula
     * @return type
     */
    public function resolveCaseThree() {
        
        $t1 = $this->resolveCaseThreeFirstEquation();
        $t2 = $this->resolveCaseThreeSecondEquation();
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
    public function resolveCaseFourth() {
        
        $t1 = $this->resolveCaseFourthFirstEquation();
        $t2 = $this->resolveCaseFourthSecondEquation();
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
    public function resolveCaseFifth() {
        
        $t1 = $this->resolveCaseFifthFirstEquation();
        $t2 = $this->resolveCaseFifthSecondEquation();
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
    public function resolveCaseSixth() {
        
        $t1 = $this->resolveCaseSixthFirstEquation();
        $t2 = $this->resolveCaseSixthSecondEquation();
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
        $dataA = $this->getAValue(null);
        
        $search = array('CU','w','b','c');
        $niddle = array($data2d->ref_value_cu,$this->waterline_height,$this->viewing_height,$dataA->ref_value_c);

        $equation = $this->simplifyEquation($search, $niddle, $this->caseOneFirstEquationFormula['formula']);
        return $this->solveEquation($equation['formula'], $this->caseOneFirstEquationFormula['isCubeRoot'], $this->caseOneFirstEquationFormula['isRoot']);
    }

    /**
     * resolve case eqations
     * @return type
     */
    public function resolveCaseOneSecondEquation() {
        $data2d = $this->get2dValue();
        $dataA = $this->getAValue(null);
        
        $search = array('BU','w','b','B');
        $niddle = array($data2d->ref_value_bu,$this->waterline_height,$this->viewing_height,$dataA->ref_value_b);
        
        $equation = $this->simplifyEquation($search, $niddle, $this->caseOneSecondEquationFormula['formula']);
        return $this->solveEquation($equation['formula'], $this->caseOneSecondEquationFormula['isCubeRoot'], $this->caseOneSecondEquationFormula['isRoot']);
    }

    /**
     * resolve case eqations
     * @return type
     */
    public function resolveCaseTwoFirstEquation() {
        $data2d = $this->get2dValue('delta_b');
        $dataB = $this->getBValue(null);
        
        $search = array('CU', 'w','b','a','c');
        $niddle = array($data2d->ref_value_cu,$this->waterline_height,$this->viewing_height,$this->viewing_length,$dataB->ref_value_c);
        
        $equation = $this->simplifyEquation($search, $niddle, $this->caseTwoFirstEquationFormula);
        
        return $this->solveEquation($equation['formula'], $this->caseTwoFirstEquationFormula['isCubeRoot'], $this->caseTwoFirstEquationFormula['isRoot']);
    }

    /**
     * resolve case eqations
     * @return type
     */
    public function resolveCaseTwoSecondEquation() {
        $data2d = $this->get2dValue('delta_b');
        $dataB = $this->getBValue(null);
        $search = array('BU','w','b','a','B');
        $niddle = array($data2d->ref_value_bu,$this->waterline_height,$this->viewing_height,$this->viewing_length,$dataB->ref_value_b);
        $equation = $this->simplifyEquation($search, $niddle, $this->caseTwoSecondEquationFormula);
        
        return $this->solveEquation($equation['formula'], $this->caseTwoSecondEquationFormula['isCubeRoot'], $this->caseTwoSecondEquationFormula['isRoot']);
    }
    
    /**
     * resolve case eqations
     * @return type
     */
    public function resolveCaseThreeFirstEquation() {
        $data2d = $this->get2dValue('delta_f');
        $dataA = $this->getAValue('delta_f');
        $search = array('CU','w','b','c');
        $niddle = array($data2d->ref_value_cu,$this->waterline_height,$this->viewing_height,$dataA->ref_value_c);
        $equation = $this->simplifyEquation($search, $niddle, $this->caseThreeFirstEquationFormula);
        return $this->solveEquation($equation['formula'], $this->caseThreeFirstEquationFormula['isCubeRoot'], $this->caseThreeFirstEquationFormula['isRoot']);
    }
    /**
     * resolve case eqations
     * @return type
     */
    public function resolveCaseThreeSecondEquation() {
        $data2d = $this->get2dValue('delta_f');
        $dataA = $this->getAValue('delta_f');
        $search = array('BU','w','b','B');
        $niddle = array($data2d->ref_value_bu,$this->waterline_height,$this->viewing_height,$dataA->ref_value_b);
        $equation = $this->simplifyEquation($search, $niddle, $this->caseThreeSecondEquationFormula);
        return $this->solveEquation($equation['formula'], $this->caseThreeSecondEquationFormula['isCubeRoot'], $this->caseThreeSecondEquationFormula['isRoot']);
    }
    /**
     * resolve case eqations
     * @return type
     */
    public function resolveCaseFourthFirstEquation() {
        $data2d = $this->get2dValue('delta_bf');
        $dataB = $this->getBValue('delta_bf');
        $search = array('CU','w','b','f','c');
        $niddle = array($data2d->ref_value_cu,$this->waterline_height,$this->viewing_height,$this->viewing_width_1,$dataB->ref_value_c);
        $equation = $this->simplifyEquation($search, $niddle, $this->caseFourthFirstEquationFormula);
        return $this->solveEquation($equation['formula'], $this->caseFourthFirstEquationFormula['isCubeRoot'], $this->caseFourthFirstEquationFormula['isRoot']);
    }
    /**
     * resolve case eqations
     * @return type
     */
    public function resolveCaseFourthSecondEquation() {
        $data2d = $this->get2dValue('delta_bf');
        $dataB = $this->getBValue('delta_bf');
        $search = array('BU','w','b','f','B');
        $niddle = array($data2d->ref_value_bu,$this->waterline_height,$this->viewing_height,$this->viewing_width_1,$dataB->ref_value_b);
        $equation = $this->simplifyEquation($search, $niddle, $this->caseFourthSecondEquationFormula);
        return $this->solveEquation($equation['formula'], $this->caseFourthSecondEquationFormula['isCubeRoot'], $this->caseFourthSecondEquationFormula['isRoot']);
    }
    /**
     * resolve case eqations
     * @return type
     */
    public function resolveCaseFifthFirstEquation() {
        $data2d = $this->get2dValue('delta_yb');
        $dataA = $this->getAValue('delta_yb');
        $search = array('CU','w','b','c');
        $niddle = array($data2d->ref_value_cu,$this->waterline_height,$this->viewing_height,$dataA->ref_value_c);
        $equation = $this->simplifyEquation($search, $niddle, $this->caseFifthFirstEquationFormula);
        return $this->solveEquation($equation['formula'], $this->caseFifthFirstEquationFormula['isCubeRoot'], $this->caseFifthFirstEquationFormula['isRoot']);
    }
    /**
     * resolve case eqations
     * @return type
     */
    public function resolveCaseFifthSecondEquation() {
        $data2d = $this->get2dValue('delta_yb');
        $dataA = $this->getAValue('delta_yb');
        $search = array('BU','w','b','B');
        $niddle = array($data2d->ref_value_bu,$this->waterline_height,$this->viewing_height,$dataA->ref_value_b);
        $equation = $this->simplifyEquation($search, $niddle, $this->caseFifthSecondEquationFormula);
        return $this->solveEquation($equation['formula'], $this->caseFifthSecondEquationFormula['isCubeRoot'], $this->caseFifthSecondEquationFormula['isRoot']);
    }
    /**
     * resolve case eqations
     * @return type
     */
    public function resolveCaseSixthFirstEquation() {
        $data2d = $this->get2dValue('delta_by');
        $dataB = $this->getBValue('delta_by');
        
        $search = array('CU','w','b','c','F');
        $niddle = array($data2d->ref_value_cu,$this->waterline_height,$this->viewing_height,$dataB->ref_value_c,$this->viewing_width_1);
        $equation = $this->simplifyEquation($search, $niddle, $this->caseSixthFirstEquationFormula);
        return $this->solveEquation($equation['formula'], $this->caseSixthFirstEquationFormula['isCubeRoot'], $this->caseSixthFirstEquationFormula['isRoot']);
    }
    /**
     * resolve case eqations
     * @return type
     */
    public function resolveCaseSixthSecondEquation() {
        $data2d = $this->get2dValue('delta_by');
        $dataB = $this->getBValue('delta_by');
        $search = array('BU','w','b','f','B');
        $niddle = array($data2d->ref_value_bu,$this->waterline_height,$this->viewing_height,$this->viewing_width_1,$dataB->ref_value_b);
        $equation = $this->simplifyEquation($search, $niddle, $this->caseSixthSecondEquationFormula);
        return $this->solveEquation($equation['formula'], $this->caseSixthSecondEquationFormula['isCubeRoot'], $this->caseSixthSecondEquationFormula['isRoot']);
    }
    
}
