<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
    <section class="col-8 mx-auto text-center">
        <table class="table border">
            <tr style="background: green; color: white;">
                <td class="p-5">
                    <h1>Report (Top Customers by product)</h1>
                </td>
            </tr>
            <tr>
                <td>
                	<table class="table table-striped table-hover text-start">
                        <tr>
                            <th>Product Name</th>
                            <th>Customer Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                        <tbody id="table_data">
                            
                        </tbody>  
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <button type="button" id="button" class="btn btn-dark">Generate Report</button>
                </td>
            </tr>
        </table>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">
    	$(document).ready(function(){
            // Load the Product table
            $("#button").on("click", function(e){
                e.preventDefault();

        		$.ajax({
                    url: "report.php",
                    type: "POST",
                    success: function(data){
                        $("#table_data").html(data);
                        $("#button").hide();
                    }
                })
            })
    	});
    </script>
</body>
</html>