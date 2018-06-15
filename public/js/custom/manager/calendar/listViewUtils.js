var the_year; //2016 
var the_month; //6
var the_month_name; //June

var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

//month digits
function getMonthDigits( yearMonth )
{
	var month = yearMonth.slice(-2);
	month = parseInt(month, 10);
	return month;
}

function getMonthDigitsWithZero( yearMonth )
{
	var month = yearMonth.slice(-2);
	return month;
}

function setMonthDigits( yearMonth )
{
	the_month = getMonthDigits(yearMonth);
} 


//month name
function setMonthName( yearMonth )
{
	the_month_name = getMonthName(yearMonth);
}

function getMonthName( yearMonth )
{
	var month = getMonthDigits(yearMonth);
	var monthName = months[month-1];
	return monthName;
}


// year
function getYear( yearMonth )
{
	var year = yearMonth.slice(0,4);
	return year;	
}

function setYear( yearMonth )
{
	the_year = getYear(yearMonth);
}

function getCurrentMonth(yearMonth)
{
	setMonthName(yearMonth);
	setYear(yearMonth);
	setMonthDigits(yearMonth);
	// getListData(yearMonth);
	renderList(yearMonth);
	console.log(the_month_name, the_year);


}

function getPrevMonth( yearMonth )
{
	var month_digits = getMonthDigits(yearMonth);
	var year = getYear(yearMonth);
	year =  parseInt(year);

	if(month_digits < 1){
		the_year = year-1;
		the_month = 12;
	} else {
		the_month = the_month-1;
	}

	the_month_name = months[the_month-1];

	var m = parseInt(the_month);
	m = pad(m, 2);
	yearMonthReturn = the_year + "-" + m;

	return yearMonthReturn;	
} 


function getNextMonth( yearMonth )
{
	var month_digits = getMonthDigits(yearMonth);
	var year = getYear(yearMonth);
	year =  parseInt(year);

	if(month_digits > 12){
		the_year = year+1;
		the_month = 1;
	} else {
		the_month = the_month+1;
	}

	the_month_name = months[the_month-1];

	var m = parseInt(the_month);
	m = pad(m, 2);
	yearMonthReturn = the_year + "-" + m;

	return yearMonthReturn;
}

// function getListData(yearMonth)
// {
// 	var storeno = localStorage.getItem('userStoreNumber');

// 	$.ajax({
// 		url : "/" + storeno + "/calendar/listevents/" + yearMonth,
// 	    type: 'GET'
// 	}).done(function( data ){
// 		console.log(data);
// 		renderList(yearMonth);
// 	});
// }

function renderList(yearMonth)
{
	//set the title of the list
	$('.month-name').html( the_month_name);
	$('.year').html(the_year);
	// var storeno = localStorage.getItem('userStoreNumber');
	$(".event-list-partial").load("/manager/calendar/eventlistpartial/" + yearMonth);

}

function pad(num, size) {
    var s = num+"";
    while (s.length < size) s = "0" + s;
    return s;
}
