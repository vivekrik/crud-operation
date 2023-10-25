<?php 
$con=mysqli_connect('localhost','root','','stddata');
if(!$con){
    echo "Not connected";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Document</title>
</head>


<body>



    <div class="container">
        <div class="alert alert-success b-success alert-dismissible fade show d-none" role="alert">
            <strong>Success!</strong> Data has been inserted successfully.
        </div>

        <div class="alert alert-success a-success alert-dismissible fade show d-none" role="alert">
            <strong>Success!</strong> Data has been updared successfully.
        </div>
        <div class="row">
            <div class="col-md-4">
                <button type="button" class="btn btn-primary px-5 m-1" id="loginbtn" data-toggle="modal"
                    data-target="#exampleModalCenter">
                    Insert Data
                </button>



                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Insert Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- <form enctype="multipart/form-data"> -->

                            <div class="modal-body">
                                <div class="form-group form-check">
                                    <label>Name:</label>
                                    <input class="form-control mt-2" type="text" id="nameform" name="nameform">
                                    <span
                                        class="text-center text-danger fs-6 custom-font d-flex align-items-center justify-content-center"
                                        id="nameformerror"></span>

                                </div>
                                <br>
                                <div class="form-group form-check">
                                    <label>Last name:</label>
                                    <input class="form-control mt-2" type="text" id="lastnameform" name="lastnameform">
                                    <span
                                        class="text-center text-danger fs-6 custom-font d-flex align-items-center justify-content-center"
                                        id="lastnameformerror"></span>

                                </div>
                                <br>
                                <div class="form-group form-check">
                                    <label>birth date:</label>
                                    <input class="form-control mt-2" type="date" id="birthform" name="birthform">
                                    <span
                                        class="text-center text-danger fs-6 custom-font d-flex align-items-center justify-content-center"
                                        id="birtherror"></span>

                                </div>
                                <br>
                                <div class="form-group form-check">
                                    <label>Contact:</label>
                                    <input class="form-control mt-2" type="number" id="contactform" name="contactform">
                                    <span
                                        class="text-center text-danger fs-6 custom-font d-flex align-items-center justify-content-center"
                                        id="contactformerror"></span>

                                </div>
                                <br>
                                <div class="form-group form-check">
                                    <label>Section:</label>
                                    <select id="selectid">
                                        <option value="">Section</option>
                                        <?php
                                                $querysection= "SELECT * FROM `stdsection`";
                                                $run= mysqli_query($con,$querysection);
                                                while($data= mysqli_fetch_array($run)){
                                                    echo "<option value=$data[0] > $data[0]</option>";

                                                }
                                                ?>
                                    </select>
                                    <span
                                        class="text-center text-danger fs-6 custom-font d-flex align-items-center justify-content-center"
                                        id="sectionerror"></span>

                                </div>
                                <br>
                                <div class="form-group form-check">
                                    <label>Email:</label>
                                    <input class="form-control mt-2" type="email" id="emaiform" name="emaiform">
                                    <span
                                        class="text-center text-danger fs-6 custom-font d-flex align-items-center justify-content-center"
                                        id="emaiformerror"></span>

                                </div>
                                <br>
                                <div class="form-group form-check">
                                    <label>Identification proof:</label>
                                    <input class="form-control mt-2" type="file" id="fileform" name="fileform"
                                        accept="image/*">
                                    <span
                                        class="text-center text-danger fs-6 custom-font d-flex align-items-center justify-content-center"
                                        id="fileerror"></span>

                                </div>
                                <br>

                            </div>
                            <div class="modal-footer">

                                <button class="btn btn-primary" name="insert" id="insertbtn">Insert</button>
                            </div>
                            <!-- </form> -->

                        </div>
                    </div>
                </div>


                <!-- Update Modal -->
                <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <input class="form-control mt-2" type="hidden" id="idform1" name="idform1">

                            <div class="modal-body">
                                <div class="form-group form-check">
                                    <label>Name:</label>
                                    <input class="form-control mt-2" type="text" id="nameform1" name="nameform1">
                                    <span
                                        class="text-center text-danger fs-6 custom-font d-flex align-items-center justify-content-center"
                                        id="nameformerror1"></span>

                                </div>
                                <br>
                                <div class="form-group form-check">
                                    <label>Last name:</label>
                                    <input class="form-control mt-2" type="text" id="lastnameform1"
                                        name="lastnameform1">
                                    <span
                                        class="text-center text-danger fs-6 custom-font d-flex align-items-center justify-content-center"
                                        id="lastnameformerror1"></span>

                                </div>
                                <br>
                                <div class="form-group form-check">
                                    <label>birth date:</label>
                                    <input class="form-control mt-2" type="date" id="birthform1" name="birthform1">
                                    <span
                                        class="text-center text-danger fs-6 custom-font d-flex align-items-center justify-content-center"
                                        id="birtherror1"></span>

                                </div>
                                <br>
                                <div class="form-group form-check">
                                    <label>Contact:</label>
                                    <input class="form-control mt-2" type="number" id="contactform1"
                                        name="contactform1">
                                    <span
                                        class="text-center text-danger fs-6 custom-font d-flex align-items-center justify-content-center"
                                        id="contactformerror1"></span>

                                </div>
                                <br>
                                <div class="form-group form-check">
                                    <label>Section:</label>
                                    <select id="selectid1">
                                        <option value="">Section</option>
                                        <?php
                                                $querysection= "SELECT * FROM `stdsection`";
                                                $run= mysqli_query($con,$querysection);
                                                while($data= mysqli_fetch_array($run)){
                                                    echo "<option value=$data[0] > $data[0]</option>";

                                                }
                                                ?>
                                    </select>
                                    <span
                                        class="text-center text-danger fs-6 custom-font d-flex align-items-center justify-content-center"
                                        id="sectionerror1"></span>

                                </div>
                                <br>
                                <div class="form-group form-check">
                                    <label>Email:</label>
                                    <input class="form-control mt-2" type="email" id="emaiform1" name="emaiform1">
                                    <span
                                        class="text-center text-danger fs-6 custom-font d-flex align-items-center justify-content-center"
                                        id="emaiformerror1"></span>

                                </div>
                                <br>
                                <div class="form-group form-check">
                                    <label>Identification proof:</label>
                                    <img src="" id="imgsrc" height="100px" width="100px">
                                    <input class="form-control mt-2" type="file" id="fileform10" name="fileform10"
                                        accept="image/*">
                                    <span
                                        class="text-center text-danger fs-6 custom-font d-flex align-items-center justify-content-center"
                                        id="fileerror10"></span>

                                </div>
                                <br>

                            </div>
                            <div class="modal-footer">

                                <button class="btn btn-primary" name="update" id="updatebtn">Update</button>
                            </div>
                            <!-- </form> -->

                        </div>
                    </div>
                </div>

                <!-- delete Modal -->

                <div class="modal fade" id="customDeleteConfirmationModal" tabindex="-1" role="dialog"
                    aria-labelledby="customModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="customModalLongTitle">Delete Confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this item?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" id="customDeleteItem">Sure</button>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <div id="viewdata">

            </div>
            <div id="viewdindex">

            </div>

        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>

</body>

</html>