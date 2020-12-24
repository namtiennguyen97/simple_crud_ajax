<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(){
        return view('create');
    }

    public function render(){
        $product = Product::all();
        $output = '';
        if (count($product)> 0){
            foreach ($product as $row){
                $output .= "<tr>
<td>$row->name</td>
<td>$row->price</td>
<td>{$row->category->name}</td>
<td><i data-id='$row->id' class=\"fas fa-trash-alt btn btn-danger deleteProduct\"></i></td>
<td><i data-id='$row->id' data-name='$row->name' data-price='$row->price' data-category_id='$row->category_id' class=\"fas fa-edit btn btn-info editProduct\"></i></td>
</tr>";
            }
        }
        else{
            $output = "<h2>No data Found</h2>";
        }

        $data = [
          'data_table' => $output
        ];

        echo json_encode($data);
    }

    public function store(Request $request){
        Product::create($request->all());
        return redirect()->route('product.index');
    }

    public function destroy($id){
        Product::destroy($id);

    }

    public function update(Request $request, $id){
        Product::find($id)->update($request->all());
    }
}
