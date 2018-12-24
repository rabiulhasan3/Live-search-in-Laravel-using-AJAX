<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Laravel Data Search with Ajax</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12 mt-5">
          <div class="form-group">
            <input type="text" name="customer_search" id="customer_search" class="form-control" placeholder="Search Customer Data" />
          </div>
          {{ csrf_field() }}
          <div class="show-data">
            <table class="table table-striped table-bordered" id="show_data_table">
              <thead>
                <tr>
                  <th>Customer Name</th>
                  <th>Address</th>
                  <th>City</th>
                  <th>Postal Code</th>
                  <th>Country</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" ></script>
    <script>
      $(document).ready(function(){
        $('#show_data_table').hide();
        $('#customer_search').keyup(function(){
          var customer_search = $('#customer_search').val();
          if (customer_search != '') {
            var _token = $('input[name="_token"]').val();
              $.ajax({
              type : 'post',
              url : "{{ route('live_search.action') }}",
              data : {
                'customer_search' : customer_search,
                '_token' : _token,
              },
              success:function(response){
                $('#show_data_table').fadeIn();
                 $('tbody').html(response);
              }
            });
          }else{
             $('#show_data_table').fadeOut();
          }
          
        });
      });
    </script>
  </body>
</html>