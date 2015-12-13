$(document).ready( function() {
	addSidebarLink();
	editSidebarLink();
	deleteSidebarLink();
	addOrganization();
	deleteOrganization();
	deleteServiceRequest();
	deleteContactRequest();
	filterSchedule();
	contactInfo();
});

function contactInfo(){	
	var firstName = $("#myInfoFirstName").val();
	var lastName = $("#myInfoLastName").val();
	$("#staffWelcome").text(firstName + " " + lastName);

    var myContactInfoForm = $('#myContactInfoForm');

    $("#myContactInfoForm input").on("blur", function() {
    	if(myContactInfoForm.hasClass("dirty")){
    		validateForm("myContactInfoForm");
    	}
    });

    $("#myContactInfoSave").on("click", function() {
    	//The user has tried submitting once so from here
    	//on out we can check to remove validation after typing
		
    	myContactInfoForm.addClass("dirty");
    	var valid = validateForm("myContactInfoForm");
		if(!valid) { 
			return;
		}
		
		$.ajax( {
			type: "POST",
			url: "php/controller/contactInfoController.php",
			data: myContactInfoForm.serialize(),
			dataType: "json",
			success: function(response) {
				if(response.success){
					window.location = "staffHome.php";
				} else {
					alert('An error has occured! Error in console.');
					console.log(response.errorMessage);
				}
			}
		});  
	});
};

function deleteServiceRequest (){
	$(document).on("click",".deleteServiceRequest", function(){
		var request = $(this);
		var requestId = request.data().id;
		$.ajax({
			type:"POST",
			url: "php/controller/staffHome/deleteServiceRequestController.php",
			data: {requestId : requestId},
			dataType: "json",
			success: function(response){
				if(response.success){
					$("#request"+requestId).parent().addClass("danger").delay(250).fadeOut();
				}else{
					alert('An error has occured! Error in console.');
					console.log(response.errorMessage);
				}
			}
		})
	});
};

function deleteContactRequest(){
	$(document).on("click",".deleteContactRequest", function(){
		var request = $(this);
		var requestId = request.data().id;
		$.ajax({
			type:"POST",
			url: "php/controller/staffHome/deleteContactRequest.php",
			data: {requestId : requestId},
			dataType: "json",
			success: function(response){
				if(response.success){
					$("#contactRequest"+requestId).parent().addClass("danger").delay(250).fadeOut();
				}else{
					alert('An error has occured! Error in console.');
					console.log(response.errorMessage);
				}
			}
		})
	});
};

function filterSchedule(){
	$("#filterSchedule").on("click",function(){
		var filterForm = $("#filterScheduleForm");
		
		var startDate = $("#scheduleStartDate").val();
		var endDate = $("#scheduleEndDate").val();
		$.ajax({
			type:"POST",
			url: "php/controller/staffHome/filterScheduleController.php",
			data: filterForm.serialize(),
			dataType: "json",
			success: function(response){
				
				if(response.success){
					debugger;
					console.log("You did it!!");
					//do something with the info
				}else{
					alert('An error has occured! Error in console');
					console.log(response.errorMessage);
				}
			},
			error: function(response) {
				console.log(response.errorMessage);
			}
		}) 
	});
}

function deleteSidebarLink() {
	$(document).on("click", ".deleteSidebarLink", function() {
		var link = $(this);
		var linkId = link.data().id;
		$.ajax( {
			type: "POST",
			url: "php/controller/staffHome/deleteSidebarLinkController.php",
			data: {
				linkId: linkId
			},
			dataType: "json",
			success: function(response) {
				if(response.success){
					$("#title" + linkId).parent().addClass("danger").delay(250).fadeOut();
				} else {
					alert('An error has occured! Error in console.');
					console.log(response.errorMessage);
				}
			}
		});  
	});
}

function editSidebarLink() {
	var currentLinkId;
	$(document).on("click", ".editSidebarLink", function() {
		var link = $(this);
		var linkId = link.data().id;
		currentLinkId = linkId;
		var linkTitle = $("#title" + linkId).text();
		var linkAddress = $("#link" + linkId).text();
		var linkIsArchived = parseInt($("#isArchived" + linkId).text());
		$("#editSidebarLinkId").val(linkId);
		$("#editSidebarLinkTitle").val(linkTitle);
		$("#editSidebarLinkAddress").val(linkAddress);
		if(linkIsArchived === 0) {
			$("#editSidebarLinkIsNotArchived").prop("checked", true);
		} else {
			$("#editSidebarLinkIsArchived").prop("checked", true);
		}
		$('#editSidebarLinkModal').modal('show');
	});

	var editSidebarLinkForm = $('#editSidebarLinkForm');

    $("#editSidebarLinkForm input").on("blur", function() {
    	if(editSidebarLinkForm.hasClass("dirty")){
    		validateForm("editSidebarLinkForm");
    	}
    });


    $("#editSidebarLinkSubmit").on("click", function() {
    	//The user has tried submitting once so from here
    	//on out we can check to remove validation after typing
    	editSidebarLinkForm.addClass("dirty");
    	var valid = validateForm("editSidebarLinkForm");

		if(!valid) { 
			return;
		}
		
		$.ajax( {
			type: "POST",
			url: "php/controller/staffHome/editSidebarLinkController.php",
			data: editSidebarLinkForm.serialize(),
			dataType: "json",
			success: function(response) {
				if(response.success){
					var newTitle = $("#editSidebarLinkTitle").val();
					var newLink = $("#editSidebarLinkAddress").val();
					var newIsArchived = $('input[name=editSidebarLinkIsArchived]').filter(':checked').val();
					$("#title" + currentLinkId).parent().addClass("success");
					$("#title" + currentLinkId).text(newTitle);
					$("#link" + currentLinkId).html("<a href=" + newLink + ">"+ newLink +"</a>");
					$("#isArchived" + currentLinkId).text(newIsArchived);
				} else {
					alert('An error has occured! Error in console.');
					console.log(response.errorMessage);
				}
			},
			complete: function() {
				//alert(currentLinkId);
				editSidebarLinkForm.trigger("reset");
				$('#editSidebarLinkModal').modal('hide');
			}
		});  
	});
}

function addSidebarLink() {
	var addSidebarLinkForm = $('#addSidebarLinkForm');

    $("#addSidebarLinkForm input").on("blur", function() {
    	if(addSidebarLinkForm.hasClass("dirty")){
    		validateForm("addSidebarLinkForm");
    	}
    });


    $("#addSidebarLinkSubmit").on("click", function() {
    	//The user has tried submitting once so from here
    	//on out we can check to remove validation after typing
    	addSidebarLinkForm.addClass("dirty");
    	var valid = validateForm("addSidebarLinkForm");

		if(!valid) { 
			return;
		}
		
		$.ajax( {
			type: "POST",
			url: "php/controller/staffHome/addSidebarLinkController.php",
			data: addSidebarLinkForm.serialize(),
			dataType: "json",
			success: function(response) {
				if(response.success){
					var newLink = response.newLink;
					var title = "<td id='title"+ newLink.id +"'>"+ newLink.title +"</td>";
					var linkAddress = "<td id='link"+ newLink.id +"'><a target='_blank' href='"+ newLink.link +"'>"+ newLink.link +"</a></td>";
					var isArchived = "<td id='isArchived"+ newLink.id +"'>"+ newLink.isArchived +"</td>";
					var editButton = "<td class='text-right'><button type='button' class='btn btn-default editSidebarLink' data-id='"+ newLink.id +"'>Edit</button></td>";;
					var deleteButton = "<td class='text-right'><button type='button' class='btn btn-default deleteSidebarLink' data-id='"+ newLink.id +"'>Delete</button></td>";
					$('#sidebarLinksTable > tbody').hide().prepend("<tr class='success'>" + title + "" + linkAddress + "" + isArchived + "" + editButton + "" + deleteButton + "</tr>").fadeIn("slow");
				} else {
					alert('An error has occured! Error in console.');
					console.log(response.errorMessage);
				}
			},
			complete: function() {
				addSidebarLinkForm.trigger("reset");
				$('#addSidebarLinkModal').modal('hide');
			}
		});  
	});
}

function addOrganization() {
	var addOrganizationForm = $('#addOrganizationForm');

    $("#addOrganizationForm input").on("blur", function() {
    	if(addOrganizationForm.hasClass("dirty")){
    		validateForm("addOrganizationForm");
    	}
    });


    $("#addOrganizationSubmit").on("click", function() {
    	//The user has tried submitting once so from here
    	//on out we can check to remove validation after typing
    	addOrganizationForm.addClass("dirty");
    	var valid = validateForm("addOrganizationForm");

		if(!valid) { 
			return;
		}
		
		$.ajax( {
			type: "POST",
			url: "php/controller/staffHome/addOrganizationController.php",
			data: addOrganizationForm.serialize(),
			dataType: "json",
			success: function(response) {
				if(response.success){
					var newOrganization = response.newOrganization;
					var name = "<td id='organizationName"+ newOrganization.id +"'>"+ newOrganization.name +"</td>";
					var key = "<td id='link"+ newOrganization.id +"'>"+ newOrganization.key +"</td>";
					var email = "<td id='organizationEmail"+ newOrganization.id +"'>"+ newOrganization.email +"</td>";
					var address = "<td class='hidden' id='organizationAddress"+ newOrganization.id +"'>"+ newOrganization.address +"</td>";
					var city = "<td class='hidden' id='organizationCity"+ newOrganization.id +"'>"+ newOrganization.city +"</td>";
					var state = "<td class='hidden' id='organizationState"+ newOrganization.id +"'>"+ newOrganization.state +"</td>";
					var zipCode = "<td class='hidden' id='organizationzipCode"+ newOrganization.id +"'>"+ newOrganization.zipCode +"</td>";
					var editButton = "<td class='text-right'><button type='button' class='btn btn-default editOrganization' data-id='"+ newOrganization.id +"'>Edit</button></td>";;
					var deleteButton = "<td class='text-right'><button type='button' class='btn btn-default deleteOrganization' data-id='"+ newOrganization.id +"'>Delete</button></td>";
					var rows = name + "" + key + "" + email + "" + address + "" + city + "" + state + "" + zipCode + "" + editButton + "" + deleteButton;
					$('#organizationsTable > tbody').hide().prepend("<tr class='success'>"+ rows +"</tr>").fadeIn("slow");
				} else {
					alert('An error has occured! Error in console.');
					console.log(response.errorMessage);
				}
			},
			complete: function() {
				addOrganizationForm.trigger("reset");
				$('#addOrganizationModal').modal('hide');
			}
		});  
	});
}

function deleteOrganization() {
	$(document).on("click", ".deleteOrganization", function() {
		var organization = $(this);
		var organizationId = organization.data().id;
		$.ajax( {
			type: "POST",
			url: "php/controller/staffHome/deleteOrganizationController.php",
			data: {
				organizationId: organizationId
			},
			dataType: "json",
			success: function(response) {
				if(response.success){
					$("#organizationName" + organizationId).parent().addClass("danger").delay(250).fadeOut();
				} else {
					alert('An error has occured! Error in console.');
					console.log(response.errorMessage);
				}
			}
		});  
	});
}