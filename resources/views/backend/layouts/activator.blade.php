<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Geniecup Activator</title>
    <link rel="shortcut icon" href="{{Config::get('app.url') . '/public/backend/images/logo/favicon.ico'}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{Config::get('app.url').'/public/css/app.css'}}">
    <link rel="stylesheet" href="{{Config::get('app.url').'/public/css/flag-icon.css'}}">
    <link href="{{Config::get('app.url').'/public/dashboard/styles/shards-dashboards.1.1.0.min.css'}}" rel="stylesheet">
    <link rel="stylesheet" href="{{Config::get('app.url').'/public/dashboard/styles/extras.1.1.0.min.css'}}">
    <script src="{{Config::get('app.url').'/public/js/buttons.js'}}"></script>
    <link rel="stylesheet" href="{{Config::get('app.url').'/public/css/vue-multiselect.min.css'}}">
    <link rel="stylesheet" href="{{Config::get('app.url').'/public/css/custom.css'}}">
</head>

<body>
    <div class="container-fluid">
    <div class="row">
    <div class="col-3"></div>
    <div class="col-6">
    @if(session()->has("message"))
<div class="alert alert-{{session("message_type")}}">
  <p> {{session("message")}} </p>
</div>
@endif
    
    <form method="post" action="{{Config::get('app.url').'register-company'}}" id="frmsignup" >
    @csrf
								<div class="portlet-body">
									<div class="tabbable tabbable-tabdrop">													
										<div class="col-md-12">
											<p style="text-align:left">
												Hi <br>
												Please setup the software with your personalized database

											</p>		
										</div>	
										
										<div class="col-md-12">
											<p style="text-align:left;background:#ccc;padding:6px;">Company info</p>		
										</div>	
										<div class="col-md-5" align="left">
											<label>Company Name <span style="color:red;">*</span></label>											
										</div>	
										<div class="col-md-7 signup-right2">
											<input type="text" class="form-control" name="fname" id="fname" placeholder="Organization Name" value="" >
										</div>		
										<div class="col-md-5" align="left">
											<label>Branch Name <span style="color:red;">*</span></label>											
										</div>	
										<div class="col-md-7 signup-right2">
											<input type="text" class="form-control" name="branch" id="branch" placeholder="Branch Name" value="Main-Branch" >
										</div>		
										<div class="col-md-5" align="left">
											<label>Warehouse Name <span style="color:red;">*</span></label>											
										</div>	
										<div class="col-md-7 signup-right2">
											<input type="text" class="form-control" name="warehouse" id="warehouse" placeholder="Warehouse Name" value="Main-Warehouse" >
										</div>	
										<div class="col-md-5" align="left">
											<label>Address 1 <span style="color:red;">*</span></label>											
										</div>	
										<div class="col-md-7 signup-right2">
											<input type="text" class="form-control" name="address" id="address1" placeholder="Address 1" value="" >
										</div>	
										<div class="col-md-5" align="left">
											<label>Address 2</label>											
										</div>	
										<div class="col-md-7 signup-right2">
											<input type="text" class="form-control" name="address2" id="address2" placeholder="Address 2" >
										</div>	
                                        <div class="col-md-5" align="left">
											<label>City <span style="color:red;">*</span></label>											
										</div>	
										<div class="col-md-7 signup-right2">
                                        <select name="city" id="city" class="form-control csroundbox" data-placeholder="city" style="text-align:left;">
											<option value="">Select City</option>
                                            <option value="Dhaka">Dhaka</option>
                                            <option value="Slyhet">Slyhet</option>
                                            <option value="Barisal">Barisal</option>
                                            <option value="chittagong">chittagong</option>
                                            
                                           </select>
										</div>
										<div class="col-md-5" align="left">
											<label>Country <span style="color:red;">*</span></label>											
										</div>	
										<div class="col-md-7 signup-right2">
											<input type="text" value="" class="form-control" name="country" id="country" placeholder="Country" >
										</div>	
										<div class="col-md-5" align="left">
											<label>Company Phones</label>											
										</div>	
										<div class="col-md-7 signup-right2">
											<input type="text" value="" class="form-control" name="phones" id="phones" placeholder="Company Phones" >
										</div>	
										<div class="col-md-5" align="left">
											<label>Main Currency <span style="color:red;">*</span></label>											
										</div>	
										<div class="col-md-7 signup-right2">
                                        <select name="currency" id="currency" class="form-control csroundbox" data-placeholder="Currency" style="text-align:left;" onchange="loadCurrency(this)">
											<option value="">Select Currency</option>
                                            <option value="£">£-Pound sterling</option>
                                            <option value="৳">৳-Bangladeshi Taka</option>
                                            <option value="S$">S$-Singapore dollar</option>
                                            <option value="$">$-U.S. dollar</option>
                                         </select>
										</div>											
																				
										<div class="col-md-5" align="left">
											<label>Default Language <span style="color:red;">*</span></label>											
										</div>	
										<div class="col-md-7 signup-right2">
											<select name="language" id="language" class="form-control">
												<option value="">Select Language</option>
												<option value="en">English</option>
											</select>
										</div>		
										<div class="col-md-5" align="left">
											<label>Time Zone <span style="color:red;">*</span></label>											
										</div>	
										<div class="col-md-7" align="left">
											<select name="timezone" id="timezone" class="form-control selectm">
												<option value="">Search your City</option>
												<option value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa</option>
												<option value="America/Adak">(GMT-10:00) Hawaii-Aleutian</option>
												<option value="Etc/GMT+10">(GMT-10:00) Hawaii</option>
												<option value="Pacific/Marquesas">(GMT-09:30) Marquesas Islands</option>
												<option value="Pacific/Gambier">(GMT-09:00) Gambier Islands</option>
												<option value="America/Anchorage">(GMT-09:00) Alaska</option>
												<option value="America/Ensenada">(GMT-08:00) Tijuana, Baja California</option>
												<option value="Etc/GMT+8">(GMT-08:00) Pitcairn Islands</option>
												<option value="America/Los_Angeles">(GMT-08:00) Pacific Time (US & Canada)</option>
												<option value="America/Denver">(GMT-07:00) Mountain Time (US & Canada)</option>
												<option value="America/Chihuahua">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
												<option value="America/Dawson_Creek">(GMT-07:00) Arizona</option>
												<option value="America/Belize">(GMT-06:00) Saskatchewan, Central America</option>
												<option value="America/Cancun">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
												<option value="Chile/EasterIsland">(GMT-06:00) Easter Island</option>
												<option value="America/Chicago">(GMT-06:00) Central Time (US & Canada)</option>
												<option value="America/New_York">(GMT-05:00) Eastern Time (US & Canada)</option>
												<option value="America/Havana">(GMT-05:00) Cuba</option>
												<option value="America/Bogota">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
												<option value="America/Caracas">(GMT-04:30) Caracas</option>
												<option value="America/Santiago">(GMT-04:00) Santiago</option>
												<option value="America/La_Paz">(GMT-04:00) La Paz</option>
												<option value="Atlantic/Stanley">(GMT-04:00) Faukland Islands</option>
												<option value="America/Campo_Grande">(GMT-04:00) Brazil</option>
												<option value="America/Goose_Bay">(GMT-04:00) Atlantic Time (Goose Bay)</option>
												<option value="America/Glace_Bay">(GMT-04:00) Atlantic Time (Canada)</option>
												<option value="America/St_Johns">(GMT-03:30) Newfoundland</option>
												<option value="America/Araguaina">(GMT-03:00) UTC-3</option>
												<option value="America/Montevideo">(GMT-03:00) Montevideo</option>
												<option value="America/Miquelon">(GMT-03:00) Miquelon, St. Pierre</option>
												<option value="America/Godthab">(GMT-03:00) Greenland</option>
												<option value="America/Argentina/Buenos_Aires">(GMT-03:00) Buenos Aires</option>
												<option value="America/Sao_Paulo">(GMT-03:00) Brasilia</option>
												<option value="America/Noronha">(GMT-02:00) Mid-Atlantic</option>
												<option value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</option>
												<option value="Atlantic/Azores">(GMT-01:00) Azores</option>
												<option value="Europe/Belfast">(GMT) Greenwich Mean Time : Belfast</option>
												<option value="Europe/Dublin">(GMT) Greenwich Mean Time : Dublin</option>
												<option value="Europe/Lisbon">(GMT) Greenwich Mean Time : Lisbon</option>
												<option value="Europe/London">(GMT) Greenwich Mean Time : London</option>
												<option value="Africa/Abidjan">(GMT) Monrovia, Reykjavik</option>
												<option value="Europe/Amsterdam">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
												<option value="Europe/Belgrade">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
												<option value="Europe/Brussels">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
												<option value="Africa/Algiers">(GMT+01:00) West Central Africa</option>
												<option value="Africa/Windhoek">(GMT+01:00) Windhoek</option>
												<option value="Asia/Beirut">(GMT+02:00) Beirut</option>
												<option value="Africa/Cairo">(GMT+02:00) Cairo</option>
												<option value="Asia/Gaza">(GMT+02:00) Gaza</option>
												<option value="Africa/Blantyre">(GMT+02:00) Harare, Pretoria</option>
												<option value="Asia/Jerusalem">(GMT+02:00) Jerusalem</option>
												<option value="Europe/Minsk">(GMT+02:00) Minsk</option>
												<option value="Asia/Damascus">(GMT+02:00) Syria</option>
												<option value="Europe/Moscow">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
												<option value="Africa/Addis_Ababa">(GMT+03:00) Nairobi</option>
												<option value="Asia/Tehran">(GMT+03:30) Tehran</option>
												<option value="Asia/Dubai">(GMT+04:00) Abu Dhabi, Muscat</option>
												<option value="Asia/Yerevan">(GMT+04:00) Yerevan</option>
												<option value="Asia/Kabul">(GMT+04:30) Kabul</option>
												<option value="Asia/Yekaterinburg">(GMT+05:00) Ekaterinburg</option>
												<option value="Asia/Tashkent">(GMT+05:00) Tashkent</option>
												<option value="Asia/Kolkata">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
												<option value="Asia/Katmandu">(GMT+05:45) Kathmandu</option>
												<option value="Asia/Dhaka">(GMT+06:00) Astana, Dhaka</option>
												<option value="Asia/Novosibirsk">(GMT+06:00) Novosibirsk</option>
												<option value="Asia/Rangoon">(GMT+06:30) Yangon (Rangoon)</option>
												<option value="Asia/Bangkok">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
												<option value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
												<option value="Asia/Hong_Kong">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
												<option value="Asia/Irkutsk">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
												<option value="Australia/Perth">(GMT+08:00) Perth</option>
												<option value="Australia/Eucla">(GMT+08:45) Eucla</option>
												<option value="Asia/Tokyo">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
												<option value="Asia/Seoul">(GMT+09:00) Seoul</option>
												<option value="Asia/Yakutsk">(GMT+09:00) Yakutsk</option>
												<option value="Australia/Adelaide">(GMT+09:30) Adelaide</option>
												<option value="Australia/Darwin">(GMT+09:30) Darwin</option>
												<option value="Australia/Brisbane">(GMT+10:00) Brisbane</option>
												<option value="Australia/Hobart">(GMT+10:00) Hobart</option>
												<option value="Asia/Vladivostok">(GMT+10:00) Vladivostok</option>
												<option value="Australia/Lord_Howe">(GMT+10:30) Lord Howe Island</option>
												<option value="Etc/GMT-11">(GMT+11:00) Solomon Is., New Caledonia</option>
												<option value="Asia/Magadan">(GMT+11:00) Magadan</option>
												<option value="Pacific/Norfolk">(GMT+11:30) Norfolk Island</option>
												<option value="Asia/Anadyr">(GMT+12:00) Anadyr, Kamchatka</option>
												<option value="Pacific/Auckland">(GMT+12:00) Auckland, Wellington</option>
												<option value="Etc/GMT-12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
												<option value="Pacific/Chatham">(GMT+12:45) Chatham Islands</option>
												<option value="Pacific/Tongatapu">(GMT+13:00) Nuku'alofa</option>
												<option value="Pacific/Kiritimati">(GMT+14:00) Kiritimati</option>
											</select>
										</div>
																					
										<div class="col-md-12">
											<p style="text-align:left;background:#ccc;padding:6px;">Software access info</p>		
										</div>	
										<div class="col-md-5" align="left">
											<label>Company Id <span style="color:red;">*</span> <span class="check-message alertn"></span></label>											
										</div>	
										<div class="col-md-7 signup-right2">
											<input type="text" class="form-control" name="sname" id="sname"  placeholder="Company short name/brand as ID" onblur="this.value=removeSpaces(this.value);" value="" >
										</div>	
										<div class="col-md-5" align="left">
											<label>User Id <span style="color:red;">*</span> <span class="check-message alertn"></span></label>
										</div>	
										<div class="col-md-7 signup-right2">
											<input type="text" value="" class="form-control" name="user_name" id="user_name" placeholder="Admin user name" onblur="this.value=removeSpaces(this.value);" >
										</div>	
										<div class="col-md-5" align="left">
											<label>Create Password <span style="color:red;">*</span></label>											
										</div>	
										<div class="col-md-7 signup-right2">
											<input type="password" value="" class="form-control" name="password" id="password"  placeholder="Create Password" onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off onkeyup='checkPassword();'>
										</div>		
										<div class="col-md-5" align="left">
											<label>Confirm Password <span style="color:red;">*</span></label>											
										</div>	
										<div class="col-md-7 signup-right2">
											<input type="password" value="" class="form-control" name="co_password" id="co_password"  placeholder="Confirm Password" onkeyup='checkPassword();' onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off>
											<label id='pass_match_txt' style='display:none'></label>
											<span class="check-message alert"></span>
										</div>
                                        <div class="col-md-5" align="left">
											<label>Title <span style="color:red;">*</span></label>											
										</div>	
										<div class="col-md-7 signup-right2">
                                        <select name="title" id="title" class="form-control" style="width:30%;border-left: 2px solid #44B6AE !important;" required="">
								<option value="">Title</option>
								<option value="Mr.">Mr.</option>
								<option value="Ms.">Ms.</option>
								<option value="Mrs.">Mrs.</option>
								<option value="Dr.">Dr.</option>
								<option value="Prof.">Prof.</option>
							</select>
										</div>	
										<div class="col-md-5" align="left">
											<label>Your Name <span style="color:red;">*</span></label>											
										</div>	
										<div class="col-md-7 signup-right2">
											<input type="text" value="" class="form-control" name="representative" id="representative" placeholder="Representative" >
										</div>	

										<div class="col-md-5" align="left">
											<label>Email <span style="color:red;">*</span></label>											
										</div>	
										<div class="col-md-7 signup-right2">
											<input type="text" value="" class="form-control" name="username" id="username"  placeholder="Email as user id and for correspondence" ><span class="check-message alertt"></span>
										</div>	
										<div class="col-md-5" align="left">
											<label>Mobile No <span style="color:red;">*</span></label>											
										</div>	
										<div class="col-md-7 signup-right2">
											<input type="text" value="" class="form-control" name="mobile" id="mobile" placeholder="Mobile No" >
										</div>	
										
									</div>
								</div>
								<div class="col-md-12 signup-right2">
									<div align="center">
										<div class="submit">
											<button type="submit" id="submitFrm" class=" btn btn-primary download-btn">Submit</button>
											<input type="hidden" name="cus_id" value="" >
											<input type="hidden" name="ref_id" value="" >
											<input type="hidden" name="plan" value="" >
											<input type="hidden" name="mylanguage" value="en" >	
											<input type="hidden" name="year_closing" value="June" >	
											<input type="hidden" name="employees" value="10000" >
											<input type="hidden" name="brand" value="" >
											<input type="hidden" name="layout" value="" ><!-- company layout for interface -->
											<input type="hidden" name="menu" value="1" >
											<input type="hidden" name="app_addon" value="" >
											<input type="hidden" name="acode" id="acode" value="" >
											<input type="hidden" name="trl" id="trl" value="Trial" />
											<div id="waiting" style="font-size:21px;display:none;">Please wait, your database is being created...</div>
										</div>  
										<div>By Submit this form, you are agreeing to our <a href="pagebd/page/terms.php" target="_blank">terms of service</a></div>
										<div>(Pay if you continue after free trial)</div>
									</div>
								</div>
							</form>
                            </div>
    <div class="col-3"></div>
    </div>
    
    </div>
    
    <script src="{{Config::get('app.url').'/public/js/app.js'}}"></script>
    <script src="{{Config::get('app.url').'/public/js/jquery-3.5.1.min.js'}}"></script>
    <script src="{{Config::get('app.url').'/public/dashboard/scripts/Chart.min.js'}}"></script>
    <script src="{{Config::get('app.url').'/public/dashboard/scripts/shards-dashboards.1.1.0.min.js'}}"></script>
    <script src="{{Config::get('app.url').'/public/js/jquery.sharrre.min.js'}}"></script>
    <script src="{{Config::get('app.url').'/public/dashboard/scripts/extras.1.1.0.min.js'}}"></script>
</body>

</html>