<!DOCTYPE html>
<head>
    <title>Admin| mỹ Phẩm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
        Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet'/>
    <link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" />
    <link href="{{asset('public/backend/css/font-awesome.css')}}" /> 
    <link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}"/>
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}" />
    <!-- //calendar -->
    <link rel="stylesheet" href="{{asset('public/backend/css/jquery-ui.css')}}" />
    <!-- //font-awesome icons -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}" ></script>
    <script src="{{asset('public/backend/js/raphael-min.js')}}" ></script>
    <script src="{{asset('public/backend/js/morris.js')}}"></script>
    <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            fetch_delivery();
             // lấy dữ liệu ra bằng ajax
            function fetch_delivery() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{url('/select-feeship')}}",
                    method: 'POST',
                    data:{_token:_token},
                    success: function(data){
                        $('#load_delivery').html(data);
                    }
                });

            }

            //update delivery
            $(document).on('blur','.fee_feeship_edit',function(){
                var feeship_id = $(this).data('feeship_id');
                var fee_value = $(this).text();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{url('/update-delivery')}}",
                    method: 'POST',
                    data:{feeship_id:feeship_id,fee_value:fee_value,_token:_token},
                    success: function(data){
                        fetch_delivery();
                    }
                });

            });
            $('.add_delivery').on('click',function(){});

             //thêm giá ship vào từng khu vực khác nhau
            $('.add_delivery').click(function() {
                var city = $('.city').val();
                var province = $('.province').val();
                var _token = $('input[name="_token"]').val();
                var wards = $('.wards').val();
                var fee_ship = $('.fee_ship').val();

                $.ajax({
                    url: "{{url('/insert-delivery')}}",
                    method: 'POST',
                    data:{city:city,province:province,_token:_token,wards:wards,fee_ship:fee_ship},
                    success: function(data){
                        fetch_delivery();
                    }
                });
                
            });

            //thêm dữ liệu theo tỉnh thành phố, quận huyện và xã phường
            $('.choose').on('change',(function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result ='';   
                if(action=='city'){
                    result = 'province';

                }else{
                    result = 'wards';
                }
                $.ajax({
                    url: "{{url('/select-delivery')}}",
                    method: 'POST',
                    data:{action:action,ma_id:ma_id,_token:_token},
                    success: function(data){
                        $('#'+ result).html(data);
                    }
                })
            }));
        })
    </script>
</head>
<body>
    <section id="container">
    <!--header start-->
    <header class="header fixed-top clearfix">
    <!--logo start-->
    <div class="brand">
        <a href="index.html" class="logo">
        ADMIN
        </a>
        <div class="sidebar-toggle-box">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>
    <!--logo end-->

    <div class="top-nav clearfix">
        <!--search & user info start-->
        <ul class="nav pull-right top-menu">
            <li>
                <input type="text" class="form-control search" placeholder=" Search">
            </li>
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img alt="" src="{{ asset('public/backend/images/2.png') }}">
                    <span class="username">
                        <?php
                            $name = Session::get('admin_name');
                            if($name){
                                echo $name;
                            }
                        ?>
                    </span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <li><a href="#"><i class=" fa fa-suitcase"></i>Thông Tin</a></li>
                    <li><a href="#"><i class="fa fa-cog"></i> Cài Đặt</a></li>
                    <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Đăng Xuất</a></li>
                </ul>
            </li>
            <!-- user login dropdown end -->
        
        </ul>
        <!--search & user info end-->
    </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse">
            <!-- sidebar menu start-->
            <div class="leftside-navigation">
                <ul class="sidebar-menu" id="nav-accordion">
                    <li>
                        <a class="active" href="{{URL::to('/dashboard')}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Tổng Quan</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span>Đơn Hàng</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/manage-order')}}">Quản Lý Đơn Hàng</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span>Mã giảm giá</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/insert-coupon')}}">Nhập mã giảm giá</a></li>
                            <li><a href="{{URL::to('/list-coupon')}}">Quản lý mã giảm giá</a></li>
                        </ul>
                    </li>
                    
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span>Danh Mục Sản Phẩm</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/add-category-product')}}">Thêm Danh Mục Sản Phẩm</a></li>
                            <li><a href="{{URL::to('/all-category-product')}}">Liệt Kê Danh Mục Sản Phẩm</a></li>
                            
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-bookmark"></i>
                            <span>Thương Hiệu Sản Phẩm</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/add-brand-product')}}">Thêm Thương Hiệu Sản Phẩm</a></li>
                            <li><a href="{{URL::to('/all-brand-product')}}">Liệt Kê Thương Hiệu Sản Phẩm</a></li>
                            
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-barcode"></i>
                            <span>Sản Phẩm</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/add-product')}}">Thêm Sản Phẩm</a></li>
                            <li><a href="{{URL::to('/all-product')}}">Liệt Kê Sản Phẩm</a></li>
                            
                        </ul>
                    </li>

                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-barcode"></i>
                            <span>Phí Vận Chuyển</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/delivery')}}">Quản lý vận chuyển</a></li>
                            
                        </ul>
                    </li>
           </div>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

           @yield('admin_content')

        </section>
        <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                <p>© 2022 CTU. NGUYỄN ANH THƯ B1910584</p>
                </div>
            </div>
        <!-- / footer -->
    </section>
    <!--main content end-->
    </section>
    <script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('public/backend/js/scripts.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
    <!-- morris JavaScript -->	
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

    <script src="{{asset('public/backend/js/jquery-ui.js')}}"></script>

    {{-- Lọc doanh số --}}
    <script type="text/javascript">
        $(document).ready(function(){
            
            chart30daysorder();

            var chart = new Morris.Bar({
              
                element: 'myfirstchart',
              
                lineColors: ['#819c79','#fc8710','#ff6541','#a4add3','#766b56'],
                pointFillColor: ['#ffffff'],
                pointStrokeColor: ['black'],
                    fillOpacity:0.6,
                    hideHover: 'auto',
                    parseTime:false,
               
                xkey: 'period',
             
                ykeys: ['order','sales','profit','quantity'],

                behaveLikeLine: true,
              
                labels: ['Đơn hàng','Doanh số','Lợi nhuận','Số lượng']
               
            })

            function chart30daysorder(){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                url: "{{url('/days-order')}}",
                dataType: 'json',
                method: 'POST',
                data:{_token:_token},
                success: function (data) {
                    chart.setData(data);
                }
                });
            }

            $('.dashboard-filter').change(function(){
                var dashboard_value = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                url: "{{url('/dashboard-filter')}}",
                dataType: 'json',
                method: 'POST',
                data:{dashboard_value:dashboard_value,_token:_token},
                success: function (data) {
                    chart.setData(data);
                }
                });
            })

            $('#btn-dashboard-filter').click(function(){
                var _token = $('input[name="_token"]').val();
                var from_date = $('#datepicker').val();
                var to_date = $('#datepicker2').val();
                
                $.ajax({
                url: "{{url('/filter-by-date')}}",
                dataType: 'json',
                method: 'POST',
                data:{from_date:from_date,to_date:to_date,_token:_token},
                success: function (data) {
                    chart.setData(data);
                }
            });
        });
    });
        

    </script>

    {{-- format date theo năm tháng ngày --}}
    <script>
        $( function() {
          $( "#datepicker" ).datepicker();
           " dateFormat":"yy-mm-dd",
            "duration": "slow",
        } );

        $( function() {
          $( "#datepicker2" ).datepicker();
           "dateFormat": "yy-mm-dd",
           "duration" : "slow",

        } );

    </script>

    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
            $( "#format" ).on( "change", function() {
            $( "#datepicker" ).datepicker( "option", "dateFormat", $( this ).val() );
            });
        } );


        $( function() {
            $( "#datepicker2" ).datepicker();
            $( "#format2" ).on( "change", function() {
            $( "#datepicker2" ).datepicker( "option", "dateFormat", $( this ).val() );
            });
        } );
    </script>

    <script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
    <!-- calendar -->
	<script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>

    <script type="text/javascript">
        $.validate({
            
        });
    </script>

{{-- CẬP NHẬT SỐ LƯỢNG TỒN KHO --}}
<script type="text/javascript">
    $('.order_details').change(function(){
      var order_status = $(this).val();
      var order_id = $(this).children(":selected").attr("id");
      var _token = $('input[name="_token"]').val();
        // lay ra so luong
        quantity = [];
        $('input[name="product_sales_quantity"]').each(function(){
            quantity.push($(this).val());
        })
        // lấy ra số luong trong kho
        order_product_id = [];
        $('input[name="order_product_id"]').each(function(){
            order_product_id.push($(this).val());
        });

        j=0;

        for(i=0;i<order_product_id.length;i++){
            var order_qty = $('.order_qty_'+order_product_id[i]).val();
            var order_qty_storage = $('.order_qty_storage_'+order_product_id[i]).val();
            if(parseInt(order_qty)>parseInt(order_qty_storage)){
                j = j+1;
                if(j==1){

                    alert('số lượng bán trong kho không đủ');
                }
                $('.color_qty_'+order_product_id[i]).css('background','#000')
            }
        }
        if(j==0){
            
            $.ajax({
                url: "{{url('/update-order-qty')}}",
                type: 'POST',
                data:{order_status:order_status,order_id:order_id,
                    order_product_id:order_product_id,quantity:quantity,_token:_token},
                success: function (data) {
                    alert('Thay đổi tình trang đơn hàng thành công');
                    location.reload();
                }
            });
        }
       


       
        // alert(quantity);
        // alert('cập nhật thành công');
    });
  
  </script>


<script type="text/javascript">
    $('.update_quantity_order').click(function(){
        var order_product_id = $(this).data('product_id');
        var order_qty = $('.order_qty_'+order_product_id).val();
        var order_id = $('.order_code').val();
        var _token = $('input[name="_token"]').val();

        // alert(order_product_id)
        // alert(order_qty)
        // alert(order_id)
        $.ajax({
            url: "{{url('/update-qty')}}",
            type: 'POST',
            data:{order_product_id:order_product_id,order_qty:order_qty,order_id:order_id,_token:_token},
            success: function(data) {
                alert('Cập nhật số lượng thành công');
                location.reload();
            }
        });
    
    });
</script>

{{-- Gallery  --}}
<script type="text/javascript">
    $(document).ready(function(){
        load_gallery();
        function load_gallery(){
            var pro_id = $('.pro_id').val();
            var _token = $('input[name="_token"]').val();
            // alert(pro_id);

            $.ajax({
                url: "{{url('/select-gallery')}}",
                type: 'POST',
                data:{pro_id:pro_id,_token:_token},
                success: function(data) {
                   $('#gallery_load').html(data);
                }
            });
        }
        $('#file').change(function(){
            var error = "";
            var files = $('#file')[0].files;
            if(files.length>3){
                error = '<p>Bạn chọn tối đa chỉ được 3 ảnh</p>';
            }else if(files.length==''){
                error = '<p>Bạn không được để trống</p>';

            }else if(files.size> 2000000){
                error = '<p>file ảnh không được lớn hơn 2MB</p>';

            }

            if(error==''){
                
            }else{
                $('#file').val();
                $('#error-gallery').html('<span class="text-danger"></span>')
                return false;
            }
        });
        $(document).on('blur','.edit_gal_name', function(){
           var gal_id = $(this).data('gal_id');
           var gal_text = $(this).text;
          
           var _token = $('input[name="_token"]').val();

           $.ajax({
                url: "{{url('/update-gallery-name')}}",
                type: 'POST',
                data:{gal_id:gal_id,gal_text:gal_text,_token:_token},
                success: function(data) {
                    load_gallery();
                    $('#error-gallery').html('<span class="text-danger">Cập nhật tên khởi tạo thành công</span>')
                }
            });
           
        // });
        });

        $(document).on('click','.delete-gallery', function(){
           var gal_id = $(this).data('gal_id');
          
           var _token = $('input[name="_token"]').val();
            if(confirm('Bạn muốn xóa hình ảnh này không')){
                $.ajax({
                     url: "{{url('/delete-gallery')}}",
                     type: 'POST',
                     data:{gal_id:gal_id,_token:_token},
                     success: function(data) {
                         load_gallery();
                         $('#error-gallery').html('<span class="text-danger">Xóa hình ảnh thành công thành công</span>')
                     }
                 });
            }
           
        // });
        });
    });
</script>

</body>
</html>
