<?php

namespace App\Common\Panels;

class PanelFactory {
    
    public static function getPanelClass($request,$id) {
        switch($id){
            case 1 :
                return new SupportPanel3Side($request, $id);
            case 2 :   
                return new LShapePanel3Side($request, $id);
            case 3 :   
                return new UShapePanel3Side($request, $id);    
            case 4 :   
                return new SupportPanel4Side($request, $id);
            case 5 :   
                return new LShapePanel4Side($request, $id);
            case 6 :   
                return new UShapePanel4Side($request, $id);    
            case 7 :   
                return new SupportFloorPanel4Side($request, $id);    
            case 8 :   
                return new CircleHorizontalPanel($request, $id);
            case 9 :   
                return new CircleVerticalPanel($request, $id);    
            case 10 :   
                return new ConvexPanel3Side($request, $id); 
            case 11 :   
                return new ConcavePanel3Side($request, $id);
            case 12 :   
                return new ConvexPanel4Side($request, $id);    
            case 13 :   
                return new ConcavePanel4Side($request, $id);        
        }
    }
}
