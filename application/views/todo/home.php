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
    $_SESSION['view'] = 1;
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
                                        <label for="add_label">Label</label>                                        
                                        <select name="" id="add_label" class="form-control" onchange="labelFun()">
                                            <option value="personal">Personal</option>
                                            <option value="work">Work</option>
                                            <option value="shopping">Shopping</option>
                                            <option value="others">Others</option>
                                          <!-- <?php foreach($labels as $values){?>
                                            <option value="<?php echo $values["label"];?>"><?php echo ucwords($values["label"]);?></option>
                                          <?php }?> -->
                                        </select>
                                    </div>
                            </div>                            
                            <div class="col-lg-12" id="add_others_div" style="display:none;">
                                    <div class="form-group">
                                        <label for="add_others">Others</label>
                                        <input class="form-control" type="text" id="add_others"  placeholder="Enter Label" >
                                    </div>
                                    <script>
                                        function labelFun(){                                            
                                            if($("#add_label").val() == "others"){                                                
                                                $("#add_others_div").show();
                                            }else{
                                                $("#add_others_div").hide();
                                            }
                                        }
                                    </script>
                            </div>                                                                        
                            <div class="col-lg-12">
                                <button class="btn btn-lg btn-block btn-danger" id="add_btn">Add To-Do</button>
                            </div>
                        </div>
                    </div>
                    <script>
                        let tasks = [<?php echo json_encode($tasks);?>][0];                        
                        $("#add_btn").click(function(){    
                            var lab = $("#add_label").val();
                            if(lab == "others"){
                                lab = $("#add_others").val()
                            }
                            $.ajax({
                                url: '<?php echo base_url();?>todo/add',
                                type: "POST",
                                data : {
                                    'task' : $("#add_task").val(),
                                    'due' : $("#add_due").val(),
                                    'label' : lab,
                                },
                                success: function(data){
                                    data = JSON.parse(data);
                                    var new_data  = {
                                        id : data.id,
                                        userid : data.user,
                                        task: data.task,
                                        due: data.due_date,
                                        label: data.label,
                                    }                     
                                    tasks.push(new_data);  
                                    alert(data.message);
                                    view_tasks();       
                                },
                                error: function(data){
                                    alert("Server Busy.")
                                    console.log(data);
                                }
                            });
                        });
                    </script>
                    <div class="col-md-7" style="background-color:#31313A;border-left:1px solid white;">
                        <div class="container" style="margin-top:50px;">

                            <div class="row task-view">
                                <div class="col-lg-12" style="margin-top:5px;height:500px;overflow-y:scroll;border-top:1px solid grey;">                                                                           
                                    <div id="task-body">
                                    </div>
                                    <script>                                        
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
                                                        string += `<p style="color:rgba(255,255,255,0.5);text-overflow:ellipsis;font-size:12px;">No Due Specified (`+element.label.toUpperCase()+`)</p>`;
                                                    }else{
                                                        string += `<p style="color:rgba(255,255,255,0.5);text-overflow:ellipsis;font-size:12px;">Due On: `+element.due+` (`+element.label.toUpperCase()+`)</p>`;
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
                
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
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
                <label for="task">Task</label>                                    
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
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update_btn">Save changes</button>
      </div>
    </div>
  </div>
</div>
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
            </div>
        </section>
        <!-- //banner-botttom -->
        <!-- footer -->
        <?php include "footer.php"?>
        <!-- //footer -->
    </body>
</html>
