<template>
<div class="main-content-container container-fluid px-4">
 
    <!-- Small Stats Blocks -->
    <div class="row">
        <div class="col-12"><h2><h2>Report</h2></h2></div>
    </div>
                   <div class="row">
                       <div class="col-12">Total Purchase Info</div>
                       <div class="col-md-6 col-xl-3">
                           <div class="card mb-3 widget-chart widget-chart2 text-left card-btm-border card-shadow-success border-success">
                               <div class="widget-chat-wrapper-outer">
                                   <div class="widget-chart-content pt-3 pl-3 pb-1">
                                       <div class="widget-chart-flex"><div class="widget-numbers">
                                           <div class="widget-chart-flex"><div class="fsize-4">
                                               <small class="opacity-5"></small>
                                               <span>{{stock_report_arr['total_stock_quantity'].sum_of_stock_total_quantity}}</span></div></div></div></div>
                                               <h6 class="widget-subheading mb-0 opacity-5">Total Stock Quantity</h6>
                                               </div>
                                               <div class="no-gutters widget-chart-wrapper mt-3 mb-3 pl-0 he-auto row">
                                                   <div class="col-md-12">
                                                       <ngx-trend height="80" strokelinecap="round" stroke="var(--success)" strokewidth="4" smooth="true" radius="15" autodraw="true" autodrawduration="1500" autodraweasing="ease-in" class="ng-tns-c136-2" ng-reflect-height="80" ng-reflect-stroke-linecap="round" ng-reflect-stroke="var(--success)" ng-reflect-stroke-width="4" ng-reflect-smooth="true" ng-reflect-radius="15" ng-reflect-auto-draw="true" ng-reflect-auto-draw-duration="1500" ng-reflect-auto-draw-easing="ease-in" ng-reflect-data="0,10,5,22,3.6,11"><svg class="ng-tns-c136-2 ng-star-inserted" width="100%" height="80" stroke="var(--success)" stroke-width="4" stroke-linecap="round" viewBox="0 0 300 80"><!--bindings={
  "ng-reflect-ng-if": "0"
}--><path fill="none" class="ng-tns-c136-2 ng-trigger ng-trigger-pathAnimaiton" d="M 8,72
L 51.44918035829936,49.74689866412324
S 64.8,42.90909090909091 79.33110509681786,46.63024458305195
L 107.06889490318213,53.73339178058441
S 121.6,57.45454545454545 132.91284371390614,47.60469433360285
L 167.08715628609386,17.849851120942606
S 178.4,8 189.31643208207979,18.287444318067504
L 224.2835679179202,51.23982840920523
S 235.2,61.52727272727273 249.22639989260222,56.21124920843758
L 292,40" style=""></path></svg><!--bindings={
  "ng-reflect-ng-if": "true"
}--></ngx-trend></div></div></div></div></div>
<div class="col-md-6 col-xl-3">
    <div class="card mb-3 widget-chart widget-chart2 text-left card-btm-border card-shadow-primary border-primary">
        <div class="widget-chat-wrapper-outer">
            <div class="widget-chart-content pt-3 pl-3 pb-1">
                <div class="widget-chart-flex">
                    <div class="widget-numbers">
                        <div class="widget-chart-flex">
                            <div class="fsize-4">
                                <small class="opacity-5">$</small>
                                <span>{{stock_report_arr['total_stock_quantity'].sum_of_total_purchase_price}}</span></div></div></div></div>
                                <h6 class="widget-subheading mb-0 opacity-5">Total Purchase Price</h6>
                                </div><div class="no-gutters widget-chart-wrapper mt-3 mb-3 pl-0 he-auto row">
                                    <div class="col-md-12"><ngx-trend height="80" strokelinecap="round" stroke="var(--primary)" strokewidth="4" smooth="true" radius="15" autodraw="true" autodrawduration="1500" autodraweasing="ease-in" class="ng-tns-c136-3" ng-reflect-height="80" ng-reflect-stroke-linecap="round" ng-reflect-stroke="var(--primary)" ng-reflect-stroke-width="4" ng-reflect-smooth="true" ng-reflect-radius="15" ng-reflect-auto-draw="true" ng-reflect-auto-draw-duration="1500" ng-reflect-auto-draw-easing="ease-in" ng-reflect-data="120,149,193.4,200,92"><svg class="ng-tns-c136-3 ng-star-inserted" width="100%" height="80" stroke="var(--primary)" stroke-width="4" stroke-linecap="round" viewBox="0 0 300 80"><!--bindings={
  "ng-reflect-ng-if": "0"
}--><path fill="none" class="ng-tns-c136-3 ng-trigger ng-trigger-pathAnimaiton" d="M 8,55.407407407407405
L 64.42098292983303,41.7509983936137
S 79,38.22222222222222 93.06527531175817,33.00992614424987
L 135.93472468824183,17.123407189083462
S 150,11.911111111111104 164.977293099646,11.086070865246413
L 206.022706900354,8.825040245864692
S 221,8 232.14160597064543,18.04313777635645
L 292,72" style=""></path></svg><!--bindings={
  "ng-reflect-ng-if": "true"
}--></ngx-trend></div></div></div></div></div>
<div class="col-md-6 col-xl-3">
    <div class="card mb-3 widget-chart widget-chart2 text-left card-btm-border card-shadow-warning border-warning">
        <div class="widget-chat-wrapper-outer">
            <div class="widget-chart-content pt-3 pl-3 pb-1">
                <div class="widget-chart-flex">
                    <div class="widget-numbers">
                        <div class="widget-chart-flex">
                            <div class="fsize-4">
                                <small class="opacity-5">$</small>
                                <span>{{stock_report_arr['total_stock_quantity'].sum_of_total_selling_price}}</span></div></div></div></div>
                                <h6 class="widget-subheading mb-0 opacity-5">Estimate selling Price</h6>
                                </div><div class="no-gutters widget-chart-wrapper mt-3 mb-3 pl-0 he-auto row">
                                    <div class="col-md-12"><ngx-trend height="80" strokelinecap="round" stroke="var(--warning)" strokewidth="4" smooth="true" radius="15" autodraw="true" autodrawduration="1500" autodraweasing="ease-in" class="ng-tns-c136-4" ng-reflect-height="80" ng-reflect-stroke-linecap="round" ng-reflect-stroke="var(--warning)" ng-reflect-stroke-width="4" ng-reflect-smooth="true" ng-reflect-radius="15" ng-reflect-auto-draw="true" ng-reflect-auto-draw-duration="1500" ng-reflect-auto-draw-easing="ease-in" ng-reflect-data="3,7,6,16,3.6,23"><svg class="ng-tns-c136-4 ng-star-inserted" width="100%" height="80" stroke="var(--warning)" stroke-width="4" stroke-linecap="round" viewBox="0 0 300 80"><!--bindings={
  "ng-reflect-ng-if": "0"
}--><path fill="none" class="ng-tns-c136-4 ng-trigger ng-trigger-pathAnimaiton" d="M 8,72
L 50.1669579262457,62.497586946198155
S 64.8,59.2 79.77625171675103,60.04373249108457
L 106.62374828324896,61.55626750891543
S 121.6,62.4 134.66871441617315,55.03734399088836
L 165.33128558382685,37.76265600911164
S 178.4,30.4 190.69660983267872,38.99030771409669
L 222.90339016732128,61.48969228590331
S 235.2,70.08 245.32553227732782,59.01322106027268
L 292,8" style=""></path></svg><!--bindings={
  "ng-reflect-ng-if": "true"
}--></ngx-trend></div></div></div></div></div><div class="col-md-6 col-xl-3">
    <div class="card mb-3 widget-chart widget-chart2 text-left card-btm-border card-shadow-danger border-danger">
        <div class="widget-chat-wrapper-outer">
            <div class="widget-chart-content pt-3 pl-3 pb-1">
                <div class="widget-chart-flex"><div class="widget-numbers">
                    <div class="widget-chart-flex"><div class="fsize-4">
                        <small class="opacity-5">$</small><span>{{stock_report_arr['total_stock_quantity'].sum_of_total_selling_price-stock_report_arr['total_stock_quantity'].sum_of_total_purchase_price}}</span></div></div></div></div>
                        <h6 class="widget-subheading mb-0 opacity-5">Estimate Profit</h6></div><div class="no-gutters widget-chart-wrapper mt-3 mb-3 pl-0 he-auto row"><div class="col-md-12"><ngx-trend height="80" strokelinecap="round" stroke="var(--danger)" strokewidth="4" smooth="true" radius="15" autodraw="true" autodrawduration="1500" autodraweasing="ease-in" class="ng-tns-c136-5" ng-reflect-height="80" ng-reflect-stroke-linecap="round" ng-reflect-stroke="var(--danger)" ng-reflect-stroke-width="4" ng-reflect-smooth="true" ng-reflect-radius="15" ng-reflect-auto-draw="true" ng-reflect-auto-draw-duration="1500" ng-reflect-auto-draw-easing="ease-in" ng-reflect-data="0,10,5,22,3.6,11"><svg class="ng-tns-c136-5 ng-star-inserted" width="100%" height="80" stroke="var(--danger)" stroke-width="4" stroke-linecap="round" viewBox="0 0 300 80"><!--bindings={
  "ng-reflect-ng-if": "0"
}--><path fill="none" class="ng-tns-c136-5 ng-trigger ng-trigger-pathAnimaiton" d="M 8,72
L 51.44918035829936,49.74689866412324
S 64.8,42.90909090909091 79.33110509681786,46.63024458305195
L 107.06889490318213,53.73339178058441
S 121.6,57.45454545454545 132.91284371390614,47.60469433360285
L 167.08715628609386,17.849851120942606
S 178.4,8 189.31643208207979,18.287444318067504
L 224.2835679179202,51.23982840920523
S 235.2,61.52727272727273 249.22639989260222,56.21124920843758
L 292,40" style=""></path></svg><!--bindings={
  "ng-reflect-ng-if": "true"
}--></ngx-trend></div></div></div></div></div></div>
            

                <div class="row">
                    <div class="col-12">Total Purchase Info</div>
                    <div class="clearfix"></div>
                    <div class="col-3">
                        <div class="infoDiv text-center shadow p-3 mb-5 bg-body rounded">
                        <h6>Total Purchase Quantity</h6>
                        <h4>{{stock_report_arr['total_buy_info'].sum_of_total_quantity}}</h4>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="infoDiv text-center shadow p-3 mb-5 bg-body rounded">

                        <h6>Total Purchase Amount</h6>
                        <h4>{{stock_report_arr['total_buy_info'].sum_of_total_amount}}</h4>
                    </div>
                    </div>
                    <div class="col-3">
                        <div class="infoDiv text-center shadow p-3 mb-5 bg-body rounded">

                        <h6>Total Purchase Paid Amount</h6>
                        <h4>{{stock_report_arr['total_buy_info'].sum_of_total_paid_amount}}</h4>
                    </div>
                    </div>
                    <div class="col-3">
                        <div class="infoDiv text-center shadow p-3 mb-5 bg-body rounded">

                        <h6>Total Purchase Due Amount</h6>
                        <h4>{{stock_report_arr['total_buy_info'].sum_of_total_due_amount}}</h4>
                    </div>
                    </div>
                    
                </div>
            

                <div class="row">
                    <div class="col-12">Total Sales Info</div>
                    <div class="clearfix"></div>
                    <div class="col-3">
                        <div class="infoDiv text-center shadow p-3 mb-5 bg-body rounded">

                            <h6>Total Sales Quantity</h6>
                            <h4>{{stock_report_arr['total_sales_info'].sum_of_total_quantity}}</h4>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="infoDiv text-center shadow p-3 mb-5 bg-body rounded">

                            <h6>Total Sales Amount</h6>
                            <h4>{{stock_report_arr['total_sales_info'].sum_of_total_amount}}</h4>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="infoDiv text-center shadow p-3 mb-5 bg-body rounded">

                            <h6>Total Paid Amount</h6>
                            <h4>{{stock_report_arr['total_sales_info'].sum_of_total_paid_amount}}</h4>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="infoDiv text-center shadow p-3 mb-5 bg-body rounded">

                            <h6>Total Due Amount</h6>
                            <h4>{{stock_report_arr['total_sales_info'].sum_of_total_due_amount}}</h4>
                        </div>
                    </div>
                    
                </div>



                <div class="row">
                    <div class="col-12">

<flat-pickr v-model="start_date"/>
                    <flat-pickr v-model="end_date"/>
                    <button @click="loadStockReportWithFilter" class="btn btn-primary">Filter</button>

                    </div>
                    <div class="col-12">Total Purchase Info</div>
                    <div class="clearfix"></div>
                    <div class="col-3">
                        <div class="infoDiv text-center shadow p-3 mb-5 bg-body rounded">
                        <h6>Total Purchase Quantity</h6>
                        <h4>{{stock_report_filter_arr['total_buy_info'].sum_of_total_quantity}}</h4>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="infoDiv text-center shadow p-3 mb-5 bg-body rounded">

                        <h6>Total Purchase Amount</h6>
                        <h4>{{stock_report_filter_arr['total_buy_info'].sum_of_total_amount}}</h4>
                    </div>
                    </div>
                    <div class="col-3">
                        <div class="infoDiv text-center shadow p-3 mb-5 bg-body rounded">

                        <h6>Total Purchase Paid Amount</h6>
                        <h4>{{stock_report_filter_arr['total_buy_info'].sum_of_total_paid_amount}}</h4>
                    </div>
                    </div>
                    <div class="col-3">
                        <div class="infoDiv text-center shadow p-3 mb-5 bg-body rounded">

                        <h6>Total Purchase Due Amount</h6>
                        <h4>{{stock_report_filter_arr['total_buy_info'].sum_of_total_due_amount}}</h4>
                    </div>
                    </div>
                    
                </div>
            

                <div class="row">
                    <div class="col-12">Total Sales Info</div>
                    <div class="clearfix"></div>
                    <div class="col-3">
                        <div class="infoDiv text-center shadow p-3 mb-5 bg-body rounded">

                            <h6>Total Sales Quantity</h6>
                            <h4>{{stock_report_filter_arr['total_sales_info'].sum_of_total_quantity}}</h4>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="infoDiv text-center shadow p-3 mb-5 bg-body rounded">

                            <h6>Total Sales Amount</h6>
                            <h4>{{stock_report_filter_arr['total_sales_info'].sum_of_total_amount}}</h4>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="infoDiv text-center shadow p-3 mb-5 bg-body rounded">

                            <h6>Total Paid Amount</h6>
                            <h4>{{stock_report_filter_arr['total_sales_info'].sum_of_total_paid_amount}}</h4>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="infoDiv text-center shadow p-3 mb-5 bg-body rounded">

                            <h6>Total Due Amount</h6>
                            <h4>{{stock_report_filter_arr['total_sales_info'].sum_of_total_due_amount}}</h4>
                        </div>
                    </div>
                    
                </div>


            </div>
       
</template>

<script>
    export default {
        data(){
            return {
                home_text:Globals.welcome_text,
                BASE_URL:Globals.base_url,
                activeVal: 'home',
                stock_report_arr:[],
                stock_report_filter_arr:[],
                customer_list_with_dues:[],
                start_date:'',
                end_date:'',
            }
        },
        methods:{
                //get Table data
                loadStockReport() {
                var post_data = {
                    client_id: Globals.user_info_client_id,
                };
                axios.post(this.BASE_URL+"api/get_all_stock_report",post_data)
                    .then(({ data }) => {
                        this.stock_report_arr = data.reports;
                    })
                    .catch(() => {
                    console.log("Error...");
                    });
                },
                loadStockReportWithFilter() {
                var post_data = {
                    client_id: Globals.user_info_client_id,
                    start_date:this.start_date,
                    end_date:this.end_date
                };
                axios.post(this.BASE_URL+"api/get_all_stock_report_with_filter",post_data)
                    .then(({ data }) => {
                        this.stock_report_filter_arr = data.reports;
                    })
                    .catch(() => {
                    console.log("Error...");
                    });
                },
               getCurDate(){
                var currentDate = new Date();
                console.log(currentDate);
    
                var formatted_date = new Date().toJSON().slice(0,10).replace(/-/g,'-');
                console.log(formatted_date);
                this.start_date = formatted_date;
                this.end_date = formatted_date;
               }
        },
        created(){
             this.getCurDate();
            this.loadStockReport();
            this.loadStockReportWithFilter();
           
        },
        mounted() {
            this.init();
            console.log('Home Component mounted.')
        }
    }
</script>