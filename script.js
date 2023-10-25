
        function update(id) {
            $.ajax({
                url: "data.php",
                type: "POST",
                data: { id: id },
                success: function (result) {
                    let data = JSON.parse(result);

                    $("#idform1").val(data.id);
                    $("#nameform1").val(data.name);
                    $("#lastnameform1").val(data.lastname);
                    $("#birthform1").val(data.age);
                    $("#contactform1").val(data.contact);
                    $("#selectid1").val(data.section);
                    $("#emaiform1").val(data.email);
                    $("#imgsrc").attr("src", data.proof);
                    $('#exampleModalCenter1').modal('show');

                }
            })

        }

        function del(id) {
            $("#customDeleteConfirmationModal").modal("show");
            $("#customDeleteItem").click(function () {
                $.ajax({
                    url: "data.php",
                    type: "POST",
                    data: { id1: id },
                    success: function (result) {
                        $("#customDeleteConfirmationModal").modal("hide");

                        selecttabledata();
                    }

                })
            })


        }

        function errormsg(id, msg) {
            $("#" + id).text(msg);
        }

        function handleButtonClick(buttonText) {

            var indexid = buttonText;;
            $.ajax({
                url: "data.php",
                type: "POST",
                data: { ready: "ready", start: indexid },
                success: function (result) {
                    let data = JSON.parse(result);

                    let cindex = "";
                    if (indexid != 1) {
                        cindex = `<button class='cindex btn' onclick='handleButtonClick(${indexid - 1})'><

</button>`;

                    }
                    for (let i = 1; i <= data.pindex; i++) {
                        cindex += `<button id="btn-${i}" class='cindex btn btn-sm btn-outline-primary m-2' onclick='handleButtonClick(${i})'>${i}</button>`;

                    }
                    if (indexid < data.pindex) {
                        cindex += `<button class='cindex btn' onclick='handleButtonClick(${indexid + 1})'>></button>`;

                    }
                    // Append the buttons to the viewdata element

                    $("#viewdata").html(data.html + cindex);
                    // Now you can use data.pindex for your other specification
                }
            });
        }



        function selecttabledata() {
            handleButtonClick(1)

        }


        function submitFormToServer(nameform, lastnameform, birthform, contactform, selectid, emaiform, fileform) {
            let formData = new FormData();
            formData.append("nameform", nameform);
            formData.append("lastnameform", lastnameform);
            formData.append("birthform", birthform);
            formData.append("contactform", contactform);
            formData.append("selectid", selectid);
            formData.append("emaiform", emaiform);
            formData.append("fileform", fileform);
            $.ajax({
                url: "data.php",
                type: "POST",
                data: formData,
                contentType: false, // Set content type to false for FormData
                processData: false, // Set processData to false for FormData
                success: function (result) {
                    $('#exampleModalCenter').modal('hide');
                    selecttabledata();
                    $(".b-success").removeClass("d-none");

                    setTimeout(() => {
                        $(".b-success").addClass("d-none");

                    }, 3000)

                    // Reset the form inputs
                    $("#nameform").val("");
                    $("#lastnameform").val("");
                    $("#birthform").val("");
                    $("#contactform").val("");
                    $("#selectid").val("");
                    $("#emaiform").val("");
                    $("#fileform").val("");

                    // Reset any error messages
                    errormsg("nameformerror", "");
                    errormsg("lastnameformerror", "");
                    errormsg("birtherror", "");
                    errormsg("contactformerror", "");
                    errormsg("sectionerror", "");
                    errormsg("emaiformerror", "");
                    errormsg("fileerror", "");
                }
            })

        }



        $(document).ready(() => {

            $("#nameform, #lastnameform, #nameform1, #lastnameform1").on("keyup", function () {
                let idletter = $(this).val();
                if (idletter) {
                    idletter = idletter[0].toUpperCase() + idletter.slice(1).toLowerCase();
                    $(this).val(idletter);
                }
            });





            function check() {
                errormsg("nameformerror", "");
                errormsg("lastnameformerror", "");
                errormsg("birtherror", "");
                errormsg("contactformerror", "");
                errormsg("sectionerror", "");
                errormsg("emaiformerror", "");
                errormsg("fileerror", "");

            }

            $("#insertbtn").click(() => {
                check();
                let nameform = $("#nameform").val();
                let lastnameform = $("#lastnameform").val();
                let birthform = $("#birthform").val();
                let contactform = $("#contactform").val();
                let selectid = $("#selectid").val();
                let emaiform = $("#emaiform").val();
                let fileform1 = $("#fileform");
                let fileform = fileform1[0].files[0];
                let namePattern = /^[A-Za-z]{3,15}$/;
                let contactNumberPattern = /^\d{10}$/;
                let emailPattern = /^[a-z0-9._%+-]+@gmail\.com$/;
                let imgtypes = ["image/jpeg", "image/png", "image/jpg"];
                let isvalid = true;

                if (nameform === "") {
                    errormsg("nameformerror", "please insert the name");
                    isvalid = false;
                }
                else if (!namePattern.test(nameform)) {
                    errormsg("nameformerror", "Invalid name. Name must consist of 3 to 15 letters with no spaces.");
                    isvalid = false;

                }


                if (lastnameform === "") {
                    errormsg("lastnameformerror", "please insert the last name");
                    isvalid = false;
                }
                else if (!namePattern.test(lastnameform)) {
                    errormsg("lastnameformerror", "Invalid last name. Name must consist of 3 to 15 letters with no spaces.");
                    isvalid = false;
                }


                if (birthform === "") {
                    errormsg("birtherror", "please insert the valid birth date");
                    isvalid = false;
                }

                if (contactform === "") {
                    errormsg("contactformerror", "please insert the valid contact number");
                    isvalid = false;
                }
                else if (!contactNumberPattern.test(contactform)) {
                    errormsg("contactformerror", "Invalid contact number. Please enter a 10-digit number.");
                    isvalid = false;
                }



                if (selectid === "") {
                    errormsg("sectionerror", "please select the valid section");
                    isvalid = false;
                }

                if (emaiform === "") {
                    errormsg("emaiformerror", "please select the valid email");
                    isvalid = false;
                }
                else if (!emailPattern.test(emaiform)) {
                    errormsg("emaiformerror", "Invalid Gmail address. Please enter a valid Gmail address in lowercase ending with '@gmail.com'.");
                    isvalid = false;
                }


                if (!fileform) {
                    errormsg("fileerror", "please select the valid identification proof");
                    isvalid = false;
                }
                else if (fileform) {
                    if (imgtypes.includes(fileform.type)) {
                        if (fileform.size <= 40 * 1024) {
                            // errormsg("fileerror", "");
                            // isvalid = true;

                        }
                        else {
                            errormsg("fileerror", "File size is too large. Please select a smaller file max size is 40kb.");
                            isvalid = false;
                        }
                    } else {
                        errormsg("fileerror", "Invalid file type. Please select a valid image file (JPEG or PNG or JPG).");
                        isvalid = false;
                    }
                }
                if (isvalid) {
                    submitFormToServer(nameform, lastnameform, birthform, contactform, selectid, emaiform, fileform)
                }
            });



            function check1() {
                errormsg("nameformerror1", "");
                errormsg("lastnameformerror1", "");
                errormsg("birtherror1", "");
                errormsg("contactformerror1", "");
                errormsg("sectionerror1", "");
                errormsg("emaiformerror1", "");
                errormsg("fileerror10", "");

            }

            $("#updatebtn").click(function () {
                check1();
                let idform1 = $("#idform1").val()
                let nameform1 = $("#nameform1").val();
                let lastnameform1 = $("#lastnameform1").val();
                let birthform1 = $("#birthform1").val();
                let contactform1 = $("#contactform1").val();
                let selectid1 = $("#selectid1").val();
                let emaiform1 = $("#emaiform1").val();
                let imgsrc = $("#imgsrc").attr("src");

                let namePattern = /^[A-Za-z]{3,15}$/;
                let contactNumberPattern = /^\d{10}$/;
                let emailPattern = /^[a-z0-9._%+-]+@gmail\.com$/;
                let fileform10 = $("#fileform10");
                let fileform100 = fileform10[0].files[0];
                let imgtypes = ["image/jpeg", "image/png", "image/jpg"];
                let isvalid = true;
                if (nameform1 === "") {
                    errormsg("nameformerror1", "please insert the name");
                    isvalid = false;
                }
                else if (!namePattern.test(nameform1)) {
                    errormsg("nameformerror1", "Invalid name. Name must consist of 3 to 15 letters with no spaces.");
                    isvalid = false;

                }


                if (lastnameform1 === "") {
                    errormsg("lastnameformerror1", "please insert the last name");
                    isvalid = false;
                }
                else if (!namePattern.test(lastnameform1)) {
                    errormsg("lastnameformerror1", "Invalid last name. Name must consist of 3 to 15 letters with no spaces.");
                    isvalid = false;
                }


                if (birthform1 === "") {
                    errormsg("birtherror1", "please insert the valid birth date");
                    isvalid = false;
                }


                if (contactform1 === "") {
                    errormsg("contactformerror1", "please insert the valid contact number");
                    isvalid = false;
                }
                else if (!contactNumberPattern.test(contactform1)) {
                    errormsg("contactformerror1", "Invalid contact number. Please enter a 10-digit number.");
                    isvalid = false;
                }


                if (selectid1 === "") {
                    errormsg("sectionerror1", "please select the valid section");
                    isvalid = false;
                }


                if (emaiform1 === "") {
                    errormsg("emaiformerror1", "please select the valid email");
                    isvalid = false;
                }
                else if (!emailPattern.test(emaiform1)) {
                    errormsg("emaiformerror1", "Invalid Gmail address. Please enter a valid Gmail address in lowercase ending with '@gmail.com'.");
                    isvalid = false;
                }

                if (fileform100) {
                    if (imgtypes.includes(fileform100.type)) {
                        if (fileform100.size <= 40 * 1024) {
                            // errormsg("fileerror", "");
                            // isvalid = true;
                        }
                        else {
                            errormsg("fileerror10", "File size is too large. Please select a smaller file max size is 40kb.");
                            isvalid = false;
                        }
                    } else {
                        errormsg("fileerror10", "Invalid file type. Please select a valid image file (JPEG or PNG or JPG).");
                        isvalid = false;
                    }
                }


                if (isvalid) {
                    let formData = new FormData();
                    formData.append("idform1", idform1);
                    formData.append("nameform1", nameform1);
                    formData.append("lastnameform1", lastnameform1);
                    formData.append("birthform1", birthform1);
                    formData.append("contactform1", contactform1);
                    formData.append("selectid1", selectid1);
                    formData.append("emaiform1", emaiform1);
                    formData.append("fileform100", fileform100);
                    formData.append("imgsrc", imgsrc);


                    $.ajax({
                        url: "data.php",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (result) {
                            $('#fileform10').val("");
                            $('#exampleModalCenter1').modal('hide');
                            selecttabledata();
                            $(".a-success").removeClass("d-none");

                            setTimeout(() => {
                                $(".a-success").addClass("d-none");

                            }, 3000)


                        }
                    })
                }
            })
        })

        document.addEventListener("DOMContentLoaded", function () {
            selecttabledata();
        });

