<?php
    // if ($this->session->userdata("userid") != "") {
    //   redirect(base_url()."dashboard");
    // }
    // if ($this->session->flashdata("signup")) {
    //   echo "<script>alert('Registered Successfully. Please login to Continue');</script>";
    // }
    // if ($this->session->flashdata("password")) {
    //   echo "<script>alert('Password Changed Successfully. Please login to Continue');</script>";
    // }
$user = $this->session->all_userdata();
if($user['id']==""){
    redirect(base_url()."login/login");
}
else{
    echo "<p class='text-success'>".$user['id']."</p>";
}

 ?>
<!DOCTYPE html>
<html lang="zxx">
    <head>
        <title>Leon Maestro De Fitness</title>
        <link rel = "icon" type = "image/png" href = "<?php echo base_url(); ?>front_static/images/logo.png">
        <!-- For apple devices -->
        <link rel = "apple-touch-icon" type = "image/png" href = "<?php echo base_url(); ?>front_static/images/logo.png"/>
        <!-- Meta tag Keywords -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8" />
        <meta name="keywords" content="Leon Maestro De Fitness, leonmaestrodefitness, lmdf, gym, fitness, best gyms, lmf, clean gyms, gyms around me, boxing, tabata, yoga" />
        <script>
            addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);

            function hideURLbar() {
                window.scrollTo(0, 1);
            }
        </script>        
        <!-- //Meta tag Keywords -->
        <!-- Custom-Files -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>front_static/css/bootstrap.css">
        <!-- Bootstrap-Core-CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>front_static/css/style.css" type="text/css" media="all" />
        <!-- Style-CSS -->
        <!-- font-awesome-icons -->
        <link href="<?php echo base_url(); ?>front_static/css/font-awesome.css" rel="stylesheet">
        <!-- //font-awesome-icons -->
        <!-- /Fonts -->
       <link href="//fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700" rel="stylesheet">
       <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
       <style>
        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            /* box-shadow: inset 0 0 5px grey; */
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #65656B;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #65656B;
        }

        .task-view:hover{
            cursor: pointer;
        }

        #del{
            background-color:#31313A;
            border:none;
            color:rgba(255,255,255,0.5);
        }

        #del:hover{
            cursor: pointer;
        }

        .task_complete:hover{
            background-color:#26262D;
        }

       </style>
        <!-- //Fonts -->        
    </head>

    <body style="background-color:#26262D;">
        <!-- header -->
        <?php include "header.php" ?>
        <!-- //header -->
        <!-- page details -->
        <div class="breadcrumb-agile">
        	<ol class="breadcrumb mb-0">
        		<li class="breadcrumb-item">
        			<a href="<?php echo base_url(); ?>">Home</a>
        		</li>
        		<li class="breadcrumb-item active" aria-current="page">Todo</li>
        	</ol>
        </div>
        <!-- //page details -->
        <!-- //banner-botttom -->
        <section class="content-info py-5">
            <div class="container py-md-5">
                <div class="row">
                    <div class="col-md-5" style="background-color:#31313A;">
                        <h3 style="color:white; margin-top:25px;" align="center">Add New To-Do</h3>
                        <div class="row" style="margin-top:15px;">
                            <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="add_task">Task</label>                                    
                                        <input class="form-control" type="text" name="task" id="add_task" placeholder="Enter Task">
                                    </div>
                            </div>
                            <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="add_due">Due Date</label>
                                        <input class="form-control" type="date" id="add_due"  placeholder="Enter Date" >
                                    </div>
                            </div>
                            <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="password">Label</label>                                        
                                        <select name="" id="add_label" class="form-control">
                                          <?php foreach($labels as $values){?>
                                            <option value="<?php echo $values["label"];?>"><?php echo ucwords($values["label"]);?></option>
                                          <?php }?>
                                        </select>
                                    </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-lg btn-block btn-danger">Add To-Do</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7" style="background-color:#31313A;border-left:1px solid white;">
                        <div class="container" style="margin-top:50px;">

                            <div class="row task-view">
                                <div class="col-lg-12" style="margin-top:5px;height:500px;overflow-y:scroll;">                                                                           
                                    <div id="task-body">
                                    </div>
                                    <script>
                                        let tasks = [<?php echo json_encode($tasks);?>][0];
                                        function view_tasks(){
                                            let string = "";
                                            tasks.forEach(element => {                                                
                                                string +=
                                            `<div class ="task_complete"><div class='row' style='margin-top:15px;border-left:3px solid purple;padding-top:10px;'>                                        
                                                    <div class='col-10' style='display:inline-block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;'>
                                                        <p style="color:white;text-overflow:ellipsis;">`+element.task +`</p>
                                                    </div>           
                                                    <div class="col-2" style="display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                                        <button id="del" style="" onclick="delete_task(`+element.userid+`,`+element.id+`)"><i class="fa fa-times"></i></button>
                                                    </div>                                        
                                            </div>
                                            <div class="row" style="margin-top:0;border-left:3px solid purple;padding-bottom:10px;">                                        
                                                    <div class="col-10" style="display:inline-block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">`;                                                
                                                    if(element.due == null){
                                                        string += `<p style="color:rgba(255,255,255,0.5);text-overflow:ellipsis;font-size:12px;">No Due Specified</p>`;
                                                    }else{
                                                        string += `<p style="color:rgba(255,255,255,0.5);text-overflow:ellipsis;font-size:12px;">Due On: `+element.due+`</p>`;
                                                    }                                                    
                                                string +=   `</div>           
                                                    <div class="col-2" style="display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                                        <button id="del" style="" onclick="edit_fun(`+element.userid+`,`+element.id+`,'`+element.task+`','`+element.due+`')"><i class="fa fa-edit"></i></button>
                                                    </div>                                        
                                            </div></div> `;
                                            });
                                            $("#task-body").html(string);
                                        }

                                        view_tasks();

                                        function delete_task(userid,id){
                                            // alert(userid+" and " +id);
                                            let result = confirm("Sure you want to delete the task?")
                                            if(result){                                            
                                                $.ajax({
                                                    url: '<?php echo base_url();?>todo/delete',
                                                    type: "POST",
                                                    data : {
                                                        'userid' : userid,
                                                        'id' : id,
                                                    },
                                                    success: function(data){
                                                        data = JSON.parse(data);
                                                        console.log(data)
                                                        if(data.status){
                                                            for(var i=0;i<tasks.length;i++){
                                                                if(tasks[i].id == id){
                                                                    tasks.splice(i,1);
                                                                    view_tasks();
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                    },
                                                    error: function(data){
                                                        console.log(data);
                                                    }
                                                })
                                            }
                                        }
                                    </script>                                                                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                      Launch demo modal
                </button> -->                
                <div class="modal fade" id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="background-color:#26262D">
                        <div class="modal-content" style="background-color:#26262D">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Edit Task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="userid">Task</label>                                    
                                    <input class="form-control" type="text" name="task" id="task" placeholder="Enter Task">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="password">Due Date</label>
                                    <input class="form-control" type="date" id="due"  placeholder="Enter Date" >
                                </div>
                            </div>
                            </div>            
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="button" id="update_btn" class="btn btn-success">Save changes</button>
                        </div>
                        </div>
                    </div>
                </div>   
                <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
                <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
                <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>                           -->
                <script>
                    function edit_fun(userid,id,task,due){                                                                     
                        $("#task").val(task);
                        $("#due").val(due);
                        $("#update_btn").click(function(){
                            $.ajax({
                                url : "<?php echo base_url();?>todo/update",
                                type : "POST",
                                data: {
                                    "id": id,
                                    "userid" : userid,
                                    "task" : $("#task").val(),
                                    "due" : $("#due").val(), 
                                },
                                success : function(data){
                                    data = JSON.parse(data);
                                    var due ;
                                    if($("#due").val() == ""){
                                        due = null;
                                    }else{
                                        due = $("#due").val();
                                    }
                                    if(data.status){
                                        for(var i=0;i<tasks.length;i++){
                                            if(tasks[i].id == id){
                                                tasks[i].task = $("#task").val();
                                                tasks[i].due = due;
                                                view_tasks();
                                                $('.modal').modal('toggle');
                                                break;
                                            }
                                        }
                                    }
                                },
                                error: function(data){
                                    alert("Server Error");
                                }
                            });
                        });
                        $('.modal').modal('toggle');
                    }
                </script>                        
                               
                <!-- <div class="contact-w3pvt-form mt-5">
                    <form class="w3layouts-contact-fm" method="post" action="<?php echo base_url(); ?>separator/login_validation">
                      <p style="color:red;"><?php echo $this->session->flashdata("login_msg") . "<br>". $this->session->userdata("userid"); ?></p>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="userid">User Id</label>
                                    <?php echo form_error("userid"); ?>
                                    <input class="form-control" type="number" name="userid" id="userid" placeholder="Enter User Id">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <?php echo form_error("password"); ?>
                                    <input class="form-control" type="password" name="password" pattern="^[a-zA-Z0-9,_.%/\#!@%*() ]*$" id="password" placeholder="Enter Password" >
                                </div>

                            </div>
                             <div class="form-group mx-auto mt-3">
                                <button class="btn submit" style="background-color:red;">Login</button>
                            </div>
                             <div class="form-group mx-auto mt-3">
                                <a href="<?php echo base_url(); ?>home/forgot" >Forgot Password?</a>
                            </div>

                        </div>
                    </form>
                </div> -->
            </div>
        </section>
        <!-- //banner-botttom -->
        <!-- footer -->
        <?php include "footer.php"?>
        <!-- //footer -->
    </body>
</html>
