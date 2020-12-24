
<form id="mainForm">
    @csrf
<table class="table-dark">
    <tr>
        <td>Name</td>
        <td><input class="form-control" type="text" name="name" placeholder="enter name"></td>
    </tr>
    <tr>
        <td>Price</td>
        <td><input class="form-control" type="number" name="price" placeholder="product price"></td>
    </tr>
    <tr>
        <td>Category</td>
        <td><select name="category_id">
                @foreach(\App\Models\Category::all() as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
            </select></td>
    </tr>
</table>
    <input type="submit" value="Add new">
</form>

<script>

</script>
