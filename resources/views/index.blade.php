<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- JavaScript -->


    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<table class="table table-bordered table-striped" id="renderTable">
    <thead>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Delete</th>
        <th>Update</th>
    </tr>
    </thead>
    <tbody id="data_table">

    </tbody>
</table>

<a id="create-form" class="btn btn-success">Add new</a>




<!-- Modal Create-->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form id="mainForm">
                    @csrf
                    <table class="table table-dark">
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
            </div>
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>--}}
{{--                <button type="button" class="btn btn-primary">Save changes</button>--}}
{{--            </div>--}}
        </div>
    </div>
</div>





<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    <table class="table table-dark">
                        <tr>
                            <td>Name:</td>
                            <td><input type="text" id="editName" class="form-control" name="name"></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td><input type="number" id="editPrice" class="form-control" name="price"></td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td>
                                <select name="category_id" id="editCategory">
                                    @foreach(\App\Models\Category::all() as $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                </select>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" value="Edit">
                </form>
            </div>
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                <button type="button" class="btn btn-primary">Save changes</button>--}}
{{--            </div>--}}
        </div>
    </div>
</div>



<script>
    render();
    function render() {
        $.ajax({
           url: "{{route('product.render')}}",
           method: 'get',
           dataType: 'json',
           success: function (data) {
                $('#data_table').html(data.data_table);
           }
        });
    }

    $('#create-form').click(function () {
        $('#createModal').modal('show');
    });

    $(document).on('submit','#mainForm', function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{route('product.store')}}",
            method: 'post',
            data: $('#mainForm').serialize(),
            success: function () {
                alertify.success("Created successfully!");
                $('#createModal').modal('hide');
                render();
            }
        })
    })


    $('#renderTable').on('click','.deleteProduct', function (e) {
        e.preventDefault();
        console.log($(this).data('id'));
        $.ajax({
            url: "destroy/"+ $(this).data('id'),
            method: 'get',
            success: function () {
                alertify.success('Deleted!');
                render();
            }
        })
    });

    // Hien thi update
    let edit_id;
    $('#data_table').on('click','.editProduct', function () {
        $('#editModal').modal('show');
        let name = $(this).data('name');
        let price = $(this).data('price');
        edit_id = $(this).data('id');
        $('#editName').val(name);
        $('#editPrice').val(price);
    })


    $('#editForm').on('submit',function (e) {

        e.preventDefault();
        $.ajax({
            url: "update/"+ edit_id,
            method: 'post',
            data: $('#editForm').serialize(),
            success: function () {
                alertify.success("Updated successfully!");
                $('#editModal').modal('hide');
                render();
            }
        })
    })


    $('.btn-close').click(function () {
        $('#createModal').modal('hide');
        $('#editModal').modal('hide');
    });
</script>
</body>
</html>
