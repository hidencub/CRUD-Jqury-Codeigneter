<!DOCTYPE html>
<html lang="en">
<head>
<title>jQuery Crud</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
    @media (min-width: 576px) {
      .jumbotron {
        padding: 1rem 2rem;
      }
    }
    .errdiv {
      color: red;
      font-weight: bold;
    }

    label {
      margin-bottom: 0;
    }

    .tdaction {
      width: 15%;
    }

    .tdSr {
      width: 7%;
    }

    .jumbotron {
      margin-bottom: 0.5rem;
    }

    strong {
      font-size: 24px !important;
    }

    input.largerCheckbox {
      width: 20px;
      height: 20px;
    }
  </style>
</head>
   <body>
    <div class="container">
        <div class="jumbotron text-center bg-success text-white">
            <h2>CRUD CODEIGNITER AJAX QURY</h2>
        </div>
        <div class="row">
            <div class="col-md-12 text-right">
                <input type="button" id="btnAdd" class="btn btn-primary para" value="Add New" />
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-12 col-sm-12 col-12 p-2 ">
                <table id="tblData" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Website</th>
                            <th class="tdaction">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6" id="trLoader">
                                <div class="text-center">
                                    Loading
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
  <div class="container">

    <script>
        var emptyRow = "<tr><td colspan='6' class='text-center'> No Records Available</td></tr>";
        var emptyNewRow = "<tr class='trNewRow'>";
        emptyNewRow = emptyNewRow + "    <td class='tdName'>";
        emptyNewRow = emptyNewRow + "        <input type='text' class='form-control txtName' placeholder='Enter Name'/>";
        emptyNewRow = emptyNewRow + "    </td>";
        emptyNewRow = emptyNewRow + "    <td class='tdUserName'>";
        emptyNewRow = emptyNewRow + "        <input type='text' class='form-control txtUserName' placeholder='Enter User Name'/>";
        emptyNewRow = emptyNewRow + "    </td>";
        emptyNewRow = emptyNewRow + "    <td class='tdEmail'>";
        emptyNewRow = emptyNewRow + "        <input type='text' class='form-control txtEmail' placeholder='Enter Email'/>";
        emptyNewRow = emptyNewRow + "    </td>";
        emptyNewRow = emptyNewRow + "    <td class='tdPhone'>";
        emptyNewRow = emptyNewRow + "        <input type='text' class='form-control txtPhone' placeholder='Enter Phone'/>";
        emptyNewRow = emptyNewRow + "    </td>";
        emptyNewRow = emptyNewRow + "    <td class='tdWebsite'>";
        emptyNewRow = emptyNewRow + "        <input type='text' class='form-control txtWebsite' placeholder='Enter Website'/>";
        emptyNewRow = emptyNewRow + "    </td>";
        emptyNewRow = emptyNewRow + "    <td class='tdAction'>";
        emptyNewRow = emptyNewRow + "        <button class='btn btn-sm btn-success btn-save'> Save</button>";
        emptyNewRow = emptyNewRow + "        <button class='btn btn-sm btn-success btn-cancel'> Cancel</button>";
        emptyNewRow = emptyNewRow + "    </td>";
        emptyNewRow = emptyNewRow + "</tr>";

        var rowButtons = "<button class='btn btn-success btn-sm btn-edit' > Edit </button>  <button class='btn btn-danger btn-sm' > Delete </button> ";
        var rowUpdateButtons = "<button class='btn btn-success btn-sm btn-save' > Update </button>  <button class='btn btn-danger btn-sm btn-save' > Cancel </button> ";
        
        $(document).ready(function () {
            loadGridData();

            $("#tblData tbody").append(emptyRow); // adding empty row on page load 

            $("#btnAdd").click(function () {
                if ($("#tblData tbody").children().children().length == 1) {
                    $("#tblData tbody").html("");
                }
                $("#tblData tbody").prepend(emptyNewRow); // appending dynamic string to table tbody
            });

            $('#tblData').on('click', '.btn-save', function () {
                const name = $(this).parent().parent().find(".txtName").val(); 
                const UserName = $(this).parent().parent().find(".txtUserName").val(); 
                const Email = $(this).parent().parent().find(".txtEmail").val();  

                const Phone = $(this).parent().parent().find(".txtPhone").val();  
                const Website = $(this).parent().parent().find(".txtWebsite").val();   

                const userObj = { 
                    "name": name,
                    "username": UserName,
                    "email": Email, 
                    "phone": Phone,
                    "website": Website
                };
                $.ajax({
                    type: "POST",
                    url: "https://jsonplaceholder.typicode.com/users",
                    contentType: false,
                    processData: false,
                    data: JSON.stringify(userObj),
                    beforeSend: function () {
                        $("#trLoader").show();
                    },
                    success: function (results) {

                    }
                });
            });

            $('#tblData').on('click', '.btn-danger', function () { // registering function for delete button  
                $.ajax({
                    type: "DELETE",
                    url: "https://jsonplaceholder.typicode.com/users/1",
                    contentType: false,
                    processData: false,
                    data: "",
                    beforeSend: function () {
                        $("#trLoader").show();
                    },
                    success: function (results) {

                    }
                });
            });

            $('#tblData').on('click', '.btn-cancel', function () {
                $(this).parent().parent().remove();
            });
            $('#tblData').on('click', '.btn-edit', function () {

                const name = $(this).parent().parent().find(".tdName").html();
                $(this).parent().parent().find(".tdName").html("<input type='text' value='" + name + "' class='form-control txtName' placeholder='Enter Name'/>");
                const UserName = $(this).parent().parent().find(".tdUserName").html();
                $(this).parent().parent().find(".tdUserName").html("<input type='text' value='" + UserName + "' class='form-control txtCity' placeholder='Enter Username'/>");
                const Email = $(this).parent().parent().find(".tdEmail").html();
                $(this).parent().parent().find(".tdEmail").html("<input type='text' value='" + Email + "' class='form-control txtMobile' placeholder='Enter Email'/>");
                const Phone = $(this).parent().parent().find(".tdPhone").html();
                $(this).parent().parent().find(".tdPhone").html("<input type='text' value='" + Phone + "' class='form-control txtMobile' placeholder='Enter Phone'/>");
                const Website = $(this).parent().parent().find(".tdWebsite").html();
                $(this).parent().parent().find(".tdWebsite").html("<input type='text' value='" + Website + "' class='form-control txtMobile' placeholder='Enter Website'/>");
                
                $(this).parent().parent().find(".tdAction").html(rowUpdateButtons);

                const userObj = { 
                    "name": name,
                    "username": UserName,
                    "email": Email, 
                    "phone": Phone,
                    "website": Website
                };
                $.ajax({
                    type: "PUT",
                    url: "https://jsonplaceholder.typicode.com/users",
                    contentType: false,
                    processData: false,
                    data: JSON.stringify(userObj),
                    beforeSend: function () {
                        $("#trLoader").show();
                    },
                    success: function (data) {
                        $
                    }
                });
            });

        function loadGridData(){
            $.ajax({
                type: "GET",
                url: "https://jsonplaceholder.typicode.com/users",
                contentType: false,
                processData: false,
                data: "",
                beforeSend: function (){
                    $("#trLoader").show();
                },
                success: function(results){
                    $("#trLoader").remove();
                    
                    if ($("#tblData tbody").children().children().length == 1) {
                    $("#tblData tbody").html("");
                }        
                    results.forEach(element => {
                        let dynamicTR = "<tr>";
                            dynamicTR=dynamicTR+"<td>"+element.name+"</td>";
                            dynamicTR=dynamicTR+"<td>"+element.username+"</td>";
                            dynamicTR=dynamicTR+"<td>"+element.email+"</td>";
                            dynamicTR=dynamicTR+"<td>"+element.phone+"</td>";
                            dynamicTR=dynamicTR+"<td>"+element.website+"</td>";
                            dynamicTR=dynamicTR+"<td class='tdaction'>"+rowButtons+"</td>";
                            dynamicTR=dynamicTR+"</tr>";
                            $("#tblData tbody").append(dynamicTR);
                    });
                }
            });
        }
        })
        
        </script>
    </body>
</html>