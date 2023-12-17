<html>
<head>
    <title>View status</title>
    
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
                        
                        <button type="button" id="produk_button" class="btn btn-info">Produk</button>
                        <button type="button" id="kategori_button" class="btn btn-info">Kategori</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <span id="success_message"></span>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Status</th>
                            <th>Nama Status</th>  
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
                    <h4 class="modal-title">Add status</h4>
                </div>
                <div class="modal-body">
                    <label>Enter Id status</label>
                    <input type="text" name="id_status" id="id_status" class="form-control" />
                    <span id="id_status_error" class="text-danger"></span>
                    <br />
                    <label>Enter Nama status</label>
                    <input type="text" name="nama_status" id="nama_status" class="form-control" />
                    <span id="nama_status_error" class="text-danger"></span>
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
            url:"<?php echo base_url(); ?>status/action",
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
    
    
    $('#produk_button').click(function(){
        location.replace("http://localhost/testing/test_api");
    });
    $('#kategori_button').click(function(){
        location.replace("http://localhost/testing/kategori");
    });

    $(document).on('submit', '#user_form', function(event){
        event.preventDefault();
        $.ajax({
            url:"<?php echo base_url() . 'status/action' ?>",
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
                    $('#nama_status_error').html(data.nama_status_error);
                    $('#harga_error').html(data.harga_error);
                    $('#status_id_error').html(data.status_id_error);
                    $('#id_status_error').html(data.id_status_error);
                    $('#status_id_error').html(data.status_id_error);
                }
            }
        })
    });

    $(document).on('click', '.edit', function(){
        var user_id = $(this).attr('id');
        $.ajax({
            url:"<?php echo base_url(); ?>status/action",
            method:"POST",
            data:{user_id:user_id, data_action:'fetch_single'},
            dataType:"json",
            success:function(data)
            {
                $('#userModal').modal('show');
                $('#nama_status').val(data.nama_status); 
                $('#id_status').val(data.id_status);
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
                url:"<?php echo base_url(); ?>status/action",
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