<html>
<head>
    <title>View Product</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
</head>
<body>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6" align="right">
                        <button type="button" id="add_button" class="btn btn-info">Add</button>
                        
                        <button type="button" id="kategori_button" class="btn btn-info">Kategori</button>
                        <button type="button" id="status_button" class="btn btn-info">Status</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <span id="success_message"></span>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Produk</th>
                            <th>Nama Produk</th> 
                            <th>Harga</th>
                            <th>ID Kategori</th>
                            <th>Id Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Produk</h4>
                </div>
                <div class="modal-body">
                    <label>Enter Id Produk</label>
                    <input type="text" name="id_produk" id="id_produk" class="form-control" />
                    <span id="id_produk_error" class="text-danger"></span>
                    <br />
                    <label>Enter Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk" class="form-control" />
                    <span id="nama_produk_error" class="text-danger"></span>
                    <br />
                    <label>Enter Harga</label>
                    <input type="text" name="harga" id="harga" class="form-control" />
                    <span id="harga_error" class="text-danger"></span>
                    <br />
                    <label>Enter Id Kategori</label>
                    <input type="text" name="kategori_id" id="kategori_id" class="form-control" />
                    <span id="kategori_id_error" class="text-danger"></span>
                    <br />
                    
                    <label>Enter Id Status</label>
                    <input type="text" name="status_id" id="status_id" class="form-control" />
                    <span id="status_id_error" class="text-danger"></span>
                    <br />
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="user_id" id="user_id" />
                    <input type="hidden" name="data_action" id="data_action" value="Insert" />
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
    
    function fetch_data()
    {
        $.ajax({
            url:"<?php echo base_url(); ?>test_api/action",
            method:"POST",
            data:{data_action:'fetch_all'},
            success:function(data)
            {
                $('tbody').html(data);
            }
        });
    }

    fetch_data();

    $('#add_button').click(function(){
        $('#user_form')[0].reset();
        $('.modal-title').text("Add Produk");
        $('#action').val('Add');
        $('#data_action').val("Insert");
        $('#userModal').modal('show');
    });
    
   $('#kategori_button').click(function(){
        location.replace("http://localhost/testing/kategori");
    });
    $('#status_button').click(function(){
        location.replace("http://localhost/testing/status");
    });

    $(document).on('submit', '#user_form', function(event){
        event.preventDefault();
        $.ajax({
            url:"<?php echo base_url() . 'test_api/action' ?>",
            method:"POST",
            data:$(this).serialize(),
            dataType:"json",
            success:function(data)
            {
                if(data.success)
                {
                    $('#user_form')[0].reset();
                    $('#userModal').modal('hide');
                    fetch_data();
                    if($('#data_action').val() == "Insert")
                    {
                        $('#success_message').html('<div class="alert alert-success">Data Inserted</div>');
                    }
                }

                if(data.error)
                {
                    $('#nama_produk_error').html(data.nama_produk_error);
                    $('#harga_error').html(data.harga_error);
                    $('#kategori_id_error').html(data.kategori_id_error);
                    $('#id_produk_error').html(data.id_produk_error);
                    $('#status_id_error').html(data.status_id_error);
                }
            }
        })
    });

    $(document).on('click', '.edit', function(){
        var user_id = $(this).attr('id');
        $.ajax({
            url:"<?php echo base_url(); ?>test_api/action",
            method:"POST",
            data:{user_id:user_id, data_action:'fetch_single'},
            dataType:"json",
            success:function(data)
            {
                $('#userModal').modal('show');
                $('#nama_produk').val(data.nama_produk);
                $('#harga').val(data.harga);
                $('#kategori_id').val(data.kategori_id); 
                $('#id_produk').val(data.id_produk);
                $('#status_id').val(data.status_id);
                $('.modal-title').text('Edit produk');
                $('#user_id').val(user_id);
                $('#action').val('Edit');
                $('#data_action').val('Edit');
            }
        })
    });

    $(document).on('click', '.delete', function(){
        var user_id = $(this).attr('id');
        if(confirm("Are you sure you want to delete this?"))
        {
            $.ajax({
                url:"<?php echo base_url(); ?>test_api/action",
                method:"POST",
                data:{user_id:user_id, data_action:'Delete'},
                dataType:"JSON",
                success:function(data)
                {
                    if(data.success)
                    {
                        $('#success_message').html('<div class="alert alert-success">Data Deleted</div>');
                        fetch_data();
                    }
                }
            })
        }
    });
    
});
</script>