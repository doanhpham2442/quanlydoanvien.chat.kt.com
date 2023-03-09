(function($) {
	"use strict";
	var HT = {}; // Khai báo là 1 đối tượng

	/* MAIN VARIABLE */

	var $window = $(window),
	    $document = $(document),
		$carousel = $(".owl-slide");
	    

	    // FUNCTION DECLARGE
	    $.fn.elExists = function() {
	        return this.length > 0;
	    };
		HT.carousel = () => {
			$carousel.each(function(){
				let _this = $(this);
				let option = _this.find('.owl-carousel').attr('data-owl');
				let owlInit = atob(option);
				owlInit = JSON.parse(owlInit);
				_this.find('.owl-carousel').owlCarousel(owlInit);
			});
			
		} 
		HT.niceSelect = function() {
			// $('select').niceSelect();
		}
	    
	    // Document ready functions
	    $document.on('ready', function() {
	    	HT.carousel();
			HT.niceSelect();
	    });

	})(jQuery);

    
$(document).ready(function(){
	
	

    $(document).on('change', '#faculty', function(e, data){
		let _this = $(this);
		let id = _this.val();
		let param = {
			'id' : id,
			'text' : '[Chọn Chi Đoàn]',
			'table' : 'classes',
			'trigger_class': (typeof(data) != 'undefined') ? true : false,
			'where' : {'faculty_id' : id},
			'select' : 'id, title',
			'object' : '#class',
		};
		get_branch(param);
	});
	if(typeof(faculty_id) != 'undefined' && faculty_id != ''){
		$('#faculty').val(faculty_id).trigger('change', [{'trigger':true}]);
	}

    $(document).on('change', '#countryside_city', function(e, data){

		let _this = $(this);
		let id = _this.val();
		let param = {
			'id' : id,
			'text' : '[Chọn Quận/Huyện]',
			'table' : 'vn_district',
			'trigger_district': (typeof(data) != 'undefined') ? true : false,
			'where' : {'provinceid' : id},
			'select' : 'districtid as id, name',
			'object' : '#countryside_district',
		};
		get_location_countryside(param);
	});

	if(typeof(countryside_cityid) != 'undefined' && countryside_cityid != ''){
		$('#countryside_city').val(countryside_cityid).trigger('change', [{'trigger':true}]);
	}

	$(document).on('change', '#countryside_district', function(){
		let _this = $(this);
		let id = _this.val();
		let param = {
			'id' : id,
			'text' : '[Chọn Phường/Xã]',
			'table' : 'vn_ward',
			'where' : {'districtid' : id},
			'select' : 'wardid as id, name',
			'object' : '#countryside_ward',
		};
		get_location_countryside(param);
	});
	// nơi cư trú-------------------------------------------------
	$(document).on('change', '#residence_city', function(e, data){
		let _this = $(this);
		let id = _this.val();
		let param = {
			'id' : id,
			'text' : '[Chọn Quận/Huyện]',
			'table' : 'vn_district',
			'trigger_district': (typeof(data) != 'undefined') ? true : false,
			'where' : {'provinceid' : id},
			'select' : 'districtid as id, name',
			'object' : '#residence_district',
		};
		get_location_residence(param);
	});

	if(typeof(residence_cityid) != 'undefined' && residence_cityid != ''){
		$('#residence_city').val(residence_cityid).trigger('change', [{'trigger':true}]);
	}

	$(document).on('change', '#residence_district', function(){
		let _this = $(this);
		let id = _this.val();
		let param = {
			'id' : id,
			'text' : '[Chọn Phường/Xã]',
			'table' : 'vn_ward',
			'where' : {'districtid' : id},
			'select' : 'wardid as id, name',
			'object' : '#residence_ward',
		};
		get_location_residence(param);
	});

    $(document).on('change', '#semester_1_id', function(e, data){
		let _this = $(this);
		let id = _this.val();
		let param = {
			'id' : id,
			'text' : '[Chọn Học Kỳ]',
			'table' : 'semesters',
			'trigger_semester': (typeof(data) != 'undefined') ? true : false,
			'select' : 'id, title',
			'object' : '#semester_2_id',
		};
		get_semester(param);
	});
	if(typeof(semester_1_id) != 'undefined' && semester_1_id != ''){
		$('#semester_1_id').val(semester_1_id).trigger('change', [{'trigger':true}]);
	}
	
	
});
function get_branch(param){
	if(class_id == '' || param.trigger_class == false) class_id = 0;

	let formURL = 'ajax/dashboard/get_branch';
	$.post(formURL, {
		param: param},
		function(data){
			let json = JSON.parse(data);
			if(param.object == '#class'){
				$(param.object).html(json.html).val(class_id).trigger('change');
			}

		});
}
function get_location_countryside(param){
	if(countryside_districtid == '' || param.trigger_district == false) countryside_districtid = 0;
	if(countryside_wardid == ''  || param.trigger_ward == false) countryside_wardid = 0;
	let formURL = 'ajax/dashboard/get_location';

    
	$.post(formURL, {
        param: param},
		function(data){
            let json = JSON.parse(data);
			if(param.object == '#countryside_district'){
                $(param.object).html(json.html).val(countryside_districtid).trigger('change');
			}else if(param.object == '#countryside_ward'){
                $(param.object).html(json.html).val(countryside_wardid);
			}
            
		});
}
function get_location_residence(param){
	if(residence_districtid == '' || param.trigger_district == false) residence_districtid = 0;
	if(residence_wardid == ''  || param.trigger_ward == false) residence_wardid = 0;

	let formURL = 'ajax/dashboard/get_location';
	$.post(formURL, {
		param: param},
		function(data){
			let json = JSON.parse(data);
			if(param.object == '#residence_district'){
				$(param.object).html(json.html).val(residence_districtid).trigger('change');
			}else if(param.object == '#residence_ward'){
				$(param.object).html(json.html).val(residence_wardid);
			}

		});
}
function get_semester(param){
	if(semester_2_id == '' || param.trigger_class == false) semester_1_id = 0;

	let formURL = 'ajax/event/get_semester';
	$.post(formURL, {
		param: param},
		function(data){
			let json = JSON.parse(data);
			// console.log(param.object);
			if(param.object == '#semester_2_id'){
				$(param.object).html(json.html).val(semester_2_id).trigger('change');
			}

		});
}
