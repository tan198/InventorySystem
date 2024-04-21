<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
      <select onchange="javascript:window.location.href='<?php echo base_url();?>LanguageSwitch/switchLang/'+this.value;">
            <option value="english" <?php if($this->session->userdata('site_lang')== 'english') echo 'selected="selected"';?>>English</option>
            <option value="vietnam" <?php if($this->session->userdata('site_lang')== 'vietnam') echo 'selected="selected"';?>>Việt Nam</option>
      </select>
        <li id="dashboardMainMenu">
          <a href="<?php echo base_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span><?php echo $this->lang->line('Dashboard')?></span>
          </a>
        </li>
        
        <!-----------------------------USER & GROUP--------------------------->


        <?php if($user_permission): ?>
        <li class="treeview" id="mainUGNav">
        <a href="#">
            <i class="fa fa-cube"></i>
            <span><?php echo $this->lang->line('User/Group')?></span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <?php if($user_permission): ?>
            <?php if(in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
              <li class="treeview" id="mainUserNav">
              <a href="#">
                <i class="fa fa-users"></i>
                <span><?php echo $this->lang->line('Users')?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <!--<?php if(in_array('createUser', $user_permission)): ?>
                <li id="createUserNav"><a href="<?php echo base_url('users/create') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Add User')?></a></li>
                <?php endif; ?>-->

                <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('createUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                <li id="manageUserNav"><a href="<?php echo base_url('users') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Manage Users')?></a></li>
              <?php endif; ?>
              </ul>
            </li>
            <?php endif; ?>

            <?php if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
              <li class="treeview" id="mainGroupNav">
                <a href="#">
                  <i class="fa fa-files-o"></i>
                  <span><?php echo $this->lang->line('Groups')?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <!--<?php if(in_array('createGroup', $user_permission)): ?>
                    <li id="addGroupNav"><a href="<?php echo base_url('groups/create') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Add Group')?> </a></li>
                  <?php endif; ?>-->
                  <?php if(in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission) || in_array('createGroup', $user_permission)): ?>
                  <li id="manageGroupNav"><a href="<?php echo base_url('groups') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Manage Groups')?></a></li>
                  <?php endif; ?>
                </ul>
              </li>
            <?php endif; ?>
          </ul>
        </li>
        <?php endif; ?>
        <!--                                -------********------                                -->

          <?php if(in_array('createFund', $user_permission) || in_array('updateFund', $user_permission) || in_array('viewFund', $user_permission) || in_array('deleteFund', $user_permission)): ?>
            <li class="treeview" id="mainFundNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span><?php echo $this->lang->line('Funds')?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <!--<?php if(in_array('createFund', $user_permission)): ?>
                  <li id="addFundNav"><a href="<?php echo base_url('fund/create') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Add Funds')?></a></li>
                <?php endif; ?>-->
                <?php if(in_array('updateFund', $user_permission) || in_array('createFund', $user_permission) || in_array('viewFund', $user_permission) || in_array('deleteFund', $user_permission)): ?>
                <li id="manageFundNav"><a href="<?php echo base_url('fund') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Manage Funds')?></a></li>
                <?php endif; ?>

                <?php if(in_array('createPayment', $user_permission) || in_array('updatePayment', $user_permission) || in_array('viewPayment', $user_permission) || in_array('deletePayment', $user_permission)): ?>
                  <li id="paymentNav">
                    <a href="<?php echo base_url('payment/') ?>">
                  <i class="fa fa-files-o"></i> <span> <?php echo $this->lang->line('Payment Type')?> </span>
              </a>
            </li>
          <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

                                    <!-- Expenditure -->

      <?php if($user_permission):?>
        <li class="treeview" id="mainEINav">
          <a href=#>
            <i class="fa fa-cube"></i>
            <span><?php echo $this->lang->line("Expenditures/Incomes");?></span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php if(in_array('createExpenditure', $user_permission) || in_array('updateExpenditure', $user_permission) || in_array('viewExpenditure', $user_permission) || in_array('deleteExpenditure', $user_permission) || in_array('createAdvances', $user_permission)): ?>
            <li class="treeview" id="mainExpenditureNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span><?php echo $this->lang->line('Expenditure')?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('updateExpenditure', $user_permission) || in_array('viewExpenditure', $user_permission) || in_array('deleteExpenditure', $user_permission)): ?>
                <li id="manageExpenditureNav"><a href="<?php echo base_url('expenditure') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Manage Expenditure')?></a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

                                            <!--Income-->

          <?php if(in_array('createIncome', $user_permission) || in_array('updateIncome', $user_permission) || in_array('viewIncome', $user_permission) || in_array('deleteIncome', $user_permission)): ?>
            <li class="treeview" id="mainIncomeNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span><?php echo $this->lang->line('Income')?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <!--<?php if(in_array('createIncome', $user_permission)): ?>
                  <li id="addIncomeNav"><a href="<?php echo base_url('income/create') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Add Income')?></a></li>
                <?php endif; ?>-->
                <?php if(in_array('createIncome', $user_permission) || in_array('updateIncome', $user_permission) || in_array('viewIncome', $user_permission) || in_array('deleteIncome', $user_permission)): ?>
                <li id="manageIncomeNav"><a href="<?php echo base_url('income') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Manage Income')?></a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
          </ul>
        </li>

      <?php endif; ?>


    
                                      <!--category-->
          <?php if(in_array('createCategory', $user_permission) || in_array('updateCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission) || in_array('createNamecate', $user_permission)|| in_array('updateNamecate', $user_permission)|| in_array('viewNamecate', $user_permission)|| in_array('deleteNamecate',$user_permission)): ?>
            <li class="treeview" id="mainCategoryNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span><?php echo $this->lang->line('Category')?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('updateCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
                  <li id="manageCategoryNav"><a href="<?php echo base_url('category') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Manage Category')?></a></li>
                <?php endif; ?>

                <?php if(in_array('createNamecate', $user_permission)|| in_array('updateNamecate', $user_permission)|| in_array('viewNamecate', $user_permission)|| in_array('deleteNamecate',$user_permission)): ?>
                  <li id="namecateNav">
                    <a href="<?php echo base_url('namecate/') ?>">
                      <i class="fa fa-files-o"></i> <span> <?php echo $this->lang->line('List Name Of Categories')?> </span>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

                                          <!--Payment-->


          <?php if(in_array('viewMaterial', $user_permission) || in_array('viewTmaterial', $user_permission)): ?>
            <li class="treeview" id="mainTMNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span><?php echo $this->lang->line('Manage Materials')?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>

              <ul class="treeview-menu">
                <?php if(in_array('createMaterials', $user_permission) || in_array('updateMaterials', $user_permission) || in_array('viewMaterials', $user_permission) || in_array('deleteMaterials', $user_permission)): ?>
                  <li id="materialsNav">
                    <a href="<?php echo base_url('materials/') ?>">
                      <i class="fa fa-files-o"></i> <span><?php echo $this->lang->line('Materials')?></span>
                    </a>
                  </li>
                <?php endif; ?>

                <?php if(in_array('createTmaterial', $user_permission) || in_array('updateTmaterial', $user_permission) || in_array('viewTmaterial', $user_permission) || in_array('deleteTmaterial', $user_permission)): ?>
              
                  <li id="tmaterialNav">
                    <a href="<?php echo base_url('tmaterial/') ?>">
                      <i class="fa fa-files-o"></i> <span><?php echo $this->lang->line('Type Materials')?></span>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
                <!--Customer/Supplier-->

        <?php if(!empty(in_array('viewCustomer', $user_permission))|| !empty(in_array('viewSupplier', $user_permission))): ?>
            <li class="treeview" id="mainCSNav">
                <a href="#">
                    <i class="fa fa-cube"></i>
                    <span><?php echo $this->lang->line('Customer/Supplier')?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php if(in_array('viewCustomer', $user_permission)): ?>
                        <li id="customerNav">
                            <a href="<?php echo base_url('customer/') ?>">
                                <i class="glyphicon glyphicon-th-list"></i> <span><?php echo $this->lang->line('Customer')?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(in_array('viewSupplier', $user_permission)): ?>
                        <li id="supplierNav">
                            <a href="<?php echo base_url('supplier/') ?>">
                                <i class="glyphicon glyphicon-th-list"></i> <span><?php echo $this->lang->line('Supplier')?></span>
                            </a>
                        </li>
                    <?php endif; ?>  
                </ul>
            </li>
        <?php endif; ?>

          
          <?php if(in_array('viewReports', $user_permission)): ?>
            <li id="reportNav">
              <a href="<?php echo base_url('reports/') ?>">
                <i class="glyphicon glyphicon-stats"></i> <span><?php echo $this->lang->line('Reports')?></span>
              </a>
            </li>
          <?php endif; ?>

          <?php if(in_array('updateCompany', $user_permission)): ?>
            <li id="companyNav"><a href="<?php echo base_url('company/') ?>"><i class="fa fa-files-o"></i> <span><?php echo $this->lang->line('Company')?> </span></a></li>
          <?php endif; ?>
        
          <?php if($user_permission): ?>
        
        <li class="treeview" id="mainSystem">
          <a href="#">
            <i class="fa fa-sitemap"></i>
            <span><?php echo lang("System"); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>

          <ul class="treeview-menu">
          <?php if(in_array('viewDepartment', $user_permission)|| in_array('updateDepartment',$user_permission)|| in_array('deleteDepartment',$user_permission)|| in_array('createDepartment',$user_permission)): ?>
            <li id="departmentNav"><a href="<?php echo base_url('department/') ?>"><i class="fa fa-user-o"></i> <span><?php echo $this->lang->line('Department')?> </span></a></li>
          <?php endif; ?>

          <?php if(in_array('updatePosition', $user_permission)|| in_array('viewPosition', $user_permission)|| in_array('deletePosition',$user_permission)|| in_array('createPosition',$user_permission)): ?>
            <li id="managePositionNav"><a href="<?php echo base_url('position')?>"><i class="fa fa-circle-o"></i><?php echo $this->lang->line('List Position') ?></a> </li>
          <?php endif; ?>
          </ul>
        </li>

      <?php endif; ?>
        
        <?php if($user_permission): ?>
        
          <li class="treeview" id="mainSettings">
            <a href="#">
              <i class="fa fa-cog"></i>
              <span><?php echo lang("Personal"); ?></span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
              </a>

            <ul class="treeview-menu">
            <?php if(in_array('viewProfile', $user_permission)): ?>
              <li><a href="<?php echo base_url('users/profile/') ?>"><i class="fa fa-user-o"></i> <span><?php echo $this->lang->line('Profile')?> </span></a></li>
            <?php endif; ?>
            <?php if(in_array('updateSetting', $user_permission)): ?>
              <li><a href="<?php echo base_url('users/setting/') ?>"><i class="fa fa-wrench"></i> <span><?php echo $this->lang->line('Edit Profile')?> </span></a></li>
            <?php endif; ?>

            
            <!-- user permission info -->
            <li><a href="<?php echo base_url('auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> <span><?php echo $this->lang->line('Logout')?></span></a></li>
            <?php endif; ?>
            </ul>
          </li>

        <?php endif; ?>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>