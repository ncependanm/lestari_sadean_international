          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php if($menu=="dashboard"){echo "active";}?>">
              <a href="<?=base_url()?>backend/dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
			
			<li class="treeview <?php if($menu=="master"){echo "active";}?>">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Master</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
		  			<li class="<?php if($subMenu=="user"){echo "active";}?>">
						<a href="<?=base_url()?>backend/user">
							<i class="fa fa-circle-o"></i> <span>User</span>
						</a>
					</li>
					<li class="<?php if($subMenu=="medsos"){echo "active";}?>">
						<a href="<?=base_url()?>backend/medsos">
							<i class="fa fa-circle-o"></i> <span>Medsos</span>
						</a>
					</li>
					<li class="<?php if($subMenu=="kategori"){echo "active";}?>">
						<a href="<?=base_url()?>backend/kategori">
							<i class="fa fa-circle-o"></i> <span>Kategori</span>
						</a>
					</li>
			  </ul>
			  </li>
	<li class="treeview <?php if($menu=="gambar"){echo "active";}?>">
              <a href="#">
                <i class="fa fa-th"></i> <span>Gambar</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">

				<li class="<?php if($subMenu=="slide"){echo "active";}?>">
				  <a href="<?=base_url()?>backend/slide">
					<i class="fa fa-circle-o"></i> <span>Slide</span>
				  </a>
				</li>
				<li class="<?php if($subMenu=="slidedua"){echo "active";}?>">
				  <a href="<?=base_url()?>backend/slidedua">
					<i class="fa fa-circle-o"></i> <span>Slide Dua</span>
				  </a>
				</li>
				<li class="<?php if($subMenu=="product"){echo "active";}?>">
				  <a href="<?=base_url()?>backend/product">
					<i class="fa fa-circle-o"></i> <span>Product</span>
				  </a>
				</li>
			  
              </ul>
            </li>
			
            <li class="<?php if($menu=="blog"){echo "active";}?>">
              <a href="<?=base_url()?>backend/blog">
                <i class="fa fa-book"></i> <span>Blog</span>
              </a>
            </li>
          </ul>