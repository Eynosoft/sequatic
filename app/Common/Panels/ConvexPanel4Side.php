<?php

namespace App\Common\Panels;
use jlawrence\eos\Parser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ConvexPanel4Side {

    protected $waterline_height;
    protected $viewing_height;
    protected $viewing_arc_length;
    protected $exterior_radius;
    protected $id;

    function __construct($request,$id) {

        /**
         * validation process
         */
        $rules = [
            'waterline_height'=>'required|numeric',
            'viewing_height'=>'required|greater_than:waterline_height|numeric',
            'viewing_arc_length'=>'required|numeric',
            'exterior_radius'=>'required|numeric',
        ];
        
        $validator = Validator::make(Input::all(), $rules)->validate();
        
        /**
         * class global variable assignment
         */
        $this->waterline_height = $request->waterline_height;
        $this->viewing_height = $request->viewing_height;
        $this->viewing_arc_length = $request->viewing_arc_length;
        $this->exterior_radius = $request->exterior_radius;
        $this->id = $id;
        
    }
    
    
    public function getValueOfT() {
        
        if(($this->viewing_length >=2*$this->waterline_height)){
             return $res = $this->resolveCaseOne();
         }else{
             return $res = $this->resolveCaseTwo();
         }
    }
    
    public function resolveCaseOne(){
        $t1 = $this->resolveCaseOneFirstEquation();
        $t2 = $this->resolveCaseOneSecondEquation();
       
        if($t1 > $t2){
             return $t1;
         }else{
             return $t2;
         }
    }
    
    public function resolveCaseOneFirstEquation(){
       $equation = "12(((0.0361*w)(w*w*w*w)/6000000)/((0.005*h)(w/h)))";

       $equation = str_replace('h', $this->viewing_height, $equation); 
       $equation = str_replace('w', $this->waterline_height, $equation); 

       $value = Parser::solve($equation);
       $eq1 = pow("$value",1/3);
       return $eq1;
    }
    
    public function resolveCaseOneSecondEquation(){
       $equation = "((0.0361*w)(w*w)/800)";
      
       $equation = str_replace('w', $this->waterline_height, $equation); 

       $value = Parser::solve($equation);
       $eq2 = sqrt($value);
       return $eq2;
    }
    
    
    
    public function resolveCaseTwo(){
        return $this->W / $this->L;
        $t1 = $this->resolveCaseTwoFirstEquation();
        $t2 = $this->resolveCaseTwoSecondEquation();
    }
    
    public function resolveCaseTwoFirstEquation(){
       $equation = "c(0.0361*w)(w*w*w*w)/200000/(0.0025*l)(w/h)";
       
       $equation = str_replace('h', $this->viewing_height, $equation); 
       $equation = str_replace('w', $this->waterline_height, $equation); 

       $value = Parser::solve($equation);
       $eq1 = pow("$value",1/3);
       return $eq1;
    }
    
    public function resolveCaseTwoSecondEquation(){
       $equation = "(b(0.0361*w)(w*w)/800)";
      
       $equation = str_replace('w', $this->waterline_height, $equation); 

       $value = Parser::solve($equation);
       $eq2 = sqrt($value);
       return $eq2;
    }
}
