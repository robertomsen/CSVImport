<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App;


class csvController extends Controller
{
    
    public function import() 
    {
        $export = [];

        //Guardamos en un array los elementos del CSV
        $csvArray = Excel::toArray($export, request()->file('file'));

        // Recorremos el array del CSV y sacamos sus filas
        foreach($csvArray[0] as $row) {
            //Nos saltamos la primera fila
            if ($row === reset($csvArray[0])) {
                continue;
            }


            // Comprobamos si la fila tiene todos los campos
            // En caso contrario, lo saltamos por no estar bien formada
            if($this->checkArrayNull($row)) {
                // Insertamos la categoria en BD (Si no esta ya)
                // Y recogemos el objeto
                $categoryId = $this->checkCategoryExist($row[0]);
                // Insertamos el producto en la BD
                $this->addProduct($categoryId[0]->id, $row); 
            }
        }
        return view('importOk');
    }

    // Función para comprobar si el array tiene algún valor NULL
    private function checkArrayNull($array) {
        $return = true;

        foreach($array as $value) {
            
            if(!isset($value)) {
                $return = false;
            }
        }
        return $return;
    }

    // Función para comprobar si la categoria existe, en caso de no
    // existir, insertamos la categoria en la BD
    private function checkCategoryExist($category) {
        $return = true;

        $categoryResult = App\Categories::where('name', $category)
                        ->get();

        if ($categoryResult->isEmpty()) {

            $newCategory = new App\Categories;
            $newCategory->name = $category;
            $newCategory->save();

            $return = $this->checkCategoryExist($category);

        }else{
            $return = $categoryResult;
        }     
        
        return $return;
    }

    // Función para añadir el producto a la BD
    private function addProduct($categoryId, $product) {

        $newProduct = new App\Products;
        $newProduct->category_id = $categoryId;
        $newProduct->name = $product[1];
        $newProduct->description = $product[2];
        $newProduct->price = $product[3];
        $newProduct->stock = $product[4];
        $newProduct->date_last_sale = $product[5];

        $newProduct->save();
    }

}


