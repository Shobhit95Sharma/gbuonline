<div class="container-fluid" style=" margin-right: 10px; margin-left: 10px;" >  
<div class="row">
    <div class="dropdown" style="margin-left:970px;size:25px">
					
					<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="size:25px;margin-top:-80px;">
						Sort By :
						<span class="caret"></span>
					</button>
					
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="margin-top:-60px;">
						<li><a href="<?php echo site_url('alumni/name')?>">Name</a></li>
						<li><a href="<?php echo site_url('alumni/cname')?>">Course Name</a></li>
                        <li><a href="<?php echo site_url('alumni/company')?>">Company</a></li>
						<li><a href="<?php echo site_url('alumni/location')?>">Location</a></li>
					</ul>
				    
				</div>   
    </div><br/>
    <div class="jumbotron" >
        <div class="row"><font face="Georgia Bold">
            <div class="col-md-3"><b>Name</b></div>
            <div class="col-md-3"><b>Course Pursued</b></div>
            <div class="col-md-3"><b>Currently Working at</b></div>
            <div class="col-md-3"><b>Current Location</b></div>
       </font></div><hr /><hr />
        
        <?php
            $r=$this->db->query("select users.username,edu_info.course_name,work_details.location,work_details.company_name from users,edu_info,alumni_basic,work_details order by location");
            $results=$r->result();
            
            foreach ($results as $rows)
            {
        ?>
            <div class="row">    
            <div class="col-md-2">
            <?php
                echo $row->username;
            ?>
            </div>
            <div class="col-md-2">
            <?php
                echo $row->course_name;
            ?>
            </div>
            <div class="col-md-2">
            <?php
                echo $row->company_name;
            ?>
            </div>
            <div class="col-md-2">
            <?php
                echo $row->location;
            ?>
            </div>
            </div><hr/>
        <?php
            }
        ?>
            </div>
                   
        
    </div>
</div>