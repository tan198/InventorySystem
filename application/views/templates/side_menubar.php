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
              <?php if(in_array('createUser', $user_permission)): ?>
              <li id="createUserNav"><a href="<?php echo base_url('users/create') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Add User')?></a></li>
              <?php endif; ?>

              <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
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
                <?php if(in_array('createGroup', $user_permission)): ?>
                  <li id="addGroupNav"><a href="<?php echo base_url('groups/create') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Add Group')?> </a></li>
                <?php endif; ?>
                <?php if(in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                <li id="manageGroupNav"><a href="<?php echo base_url('groups') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Manage Groups')?></a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>


          <?php if(in_array('createLoans', $user_permission) || in_array('updateLoans', $user_permission) || in_array('viewLoans', $user_permission) || in_array('deleteLoans', $user_permission)): ?>
            <li id="loansNav">
              <a href="<?php echo base_url('loans/') ?>">
                <i class="glyphicon glyphicon-tags"></i> <span><?php echo $this->lang->line('Loans')?></span>
              </a>
            </li>
          <?php endif; ?>

          <!--<?php if(in_array('createBrand', $user_permission) || in_array('updateBrand', $user_permission) || in_array('viewBrand', $user_permission) || in_array('deleteBrand', $user_permission)): ?>
            <li id="brandNav">
              <a href="<?php echo base_url('brands/') ?>">
                <i class="glyphicon glyphicon-tags"></i> <span><?php echo $this->lang->line('Brands')?></span>
              </a>
            </li>
          <?php endif; ?>-->

          <!--<?php if(in_array('createCategory', $user_permission) || in_array('updateCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
            <li id="categoryNav">
              <a href="<?php echo base_url('category/') ?>">
                <i class="fa fa-files-o"></i> <span><?php echo $this->lang->line('Category')?>  </span>
              </a>
            </li>
          <?php endif; ?>-->

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
                <?php if(in_array('createFund', $user_permission)): ?>
                  <li id="addFundNav"><a href="<?php echo base_url('fund/create') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Add Funds')?></a></li>
                <?php endif; ?>
                <?php if(in_array('updateFund', $user_permission) || in_array('viewFund', $user_permission) || in_array('deleteFund', $user_permission)): ?>
                <li id="manageFundNav"><a href="<?php echo base_url('fund') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Manage Funds')?></a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <!-- Expenditure -->

          <?php if(in_array('createExpenditure', $user_permission) || in_array('updateExpenditure', $user_permission) || in_array('viewExpenditure', $user_permission) || in_array('deleteExpenditure', $user_permission)): ?>
            <li class="treeview" id="mainExpenditureNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span><?php echo $this->lang->line('Expenditure')?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createExpenditure', $user_permission)): ?>
                  <li id="addExpenditureNav"><a href="<?php echo base_url('expenditure/create') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Add Expenditure')?></a></li>
                <?php endif; ?>
                <?php if(in_array('updateExpenditure', $user_permission) || in_array('viewExpenditure', $user_permission) || in_array('deleteExpenditure', $user_permission)): ?>
                <li id="manageExpenditureNav"><a href="<?php echo base_url('expenditure') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Manage Expenditure')?></a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          
          <?php if(in_array('createExpenditureType', $user_permission) || in_array('updateExpenditureType', $user_permission) || in_array('viewExpenditureType', $user_permission) || in_array('deleteExpenditureType', $user_permission)): ?>
            <li id="expendituretypeNav">
              <a href="<?php echo base_url('expendituretype/') ?>">
                <i class="fa fa-files-o"></i> <span> <?php echo $this->lang->line('Expenditure Category Type')?></span>
              </a>
            </li>
          <?php endif; ?>

    
          
          <?php if(in_array('createExpenditureCategory', $user_permission) || in_array('updateExpenditureCategory', $user_permission) || in_array('viewExpenditureCategory', $user_permission) || in_array('deleteExpenditureCategory', $user_permission)): ?>
            <li class="treeview" id="mainExpenditureCategoryNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span><?php echo $this->lang->line('Expenditure Category')?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createExpenditureCategory', $user_permission)): ?>
                  <li id="addExpenditureCategoryNav"><a href="<?php echo base_url('expenditurecategory/create') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Add Expenditure Category')?></a></li>
                <?php endif; ?>
                <?php if(in_array('updateExpenditureCategory', $user_permission) || in_array('viewExpenditureCategory', $user_permission) || in_array('deleteExpenditureCategory', $user_permission)): ?>
                <li id="manageExpenditureCategoryNav"><a href="<?php echo base_url('expenditurecategory') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Manage Expenditure Category')?></a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

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
                <?php if(in_array('createIncome', $user_permission)): ?>
                  <li id="addIncomeNav"><a href="<?php echo base_url('income/create') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Add Income')?></a></li>
                <?php endif; ?>
                <?php if(in_array('updateIncome', $user_permission) || in_array('viewIncome', $user_permission) || in_array('deleteIncome', $user_permission)): ?>
                <li id="manageIncomeNav"><a href="<?php echo base_url('income') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Manage Income')?></a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
          
          <?php if(in_array('createIncomeCategory', $user_permission) || in_array('updateIncomeCategory', $user_permission) || in_array('viewIncomeCategory', $user_permission) || in_array('deleteIncomeCategory', $user_permission)): ?>
            <li class="treeview" id="mainIncomeCategoryNav">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span><?php echo $this->lang->line('Income Category')?> </span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createIncomeCategory', $user_permission)): ?>
                  <li id="addIncomeCategoryNav"><a href="<?php echo base_url('incomecategory/create') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Add Income Category')?></a></li>
                <?php endif; ?>
                <?php if(in_array('updateIncomeCategory', $user_permission) || in_array('viewIncomeCategory', $user_permission) || in_array('deleteIncomeCategory', $user_permission)): ?>
                <li id="manageIncomeCategoryNav"><a href="<?php echo base_url('incomecategory') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Manage Income Category')?> </a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <?php if(in_array('createIncomeType', $user_permission) || in_array('updateIncomeType', $user_permission) || in_array('viewIncomeType', $user_permission) || in_array('deleteIncomeType', $user_permission)): ?>
            <li id="incometypeNav">
              <a href="<?php echo base_url('incometype/') ?>">
                <i class="fa fa-files-o"></i> <span> <?php echo $this->lang->line('Income Category Type')?></span>
              </a>
            </li>
          <?php endif; ?>

          <?php if(in_array('createPayment', $user_permission) || in_array('updatePayment', $user_permission) || in_array('viewPayment', $user_permission) || in_array('deletePayment', $user_permission)): ?>
            <li id="paymentNav">
              <a href="<?php echo base_url('payment/') ?>">
                <i class="fa fa-files-o"></i> <span> <?php echo $this->lang->line('Payment Type')?> </span>
              </a>
            </li>
          <?php endif; ?>


          <?php if(in_array('createProjectExpend', $user_permission) || in_array('updateProjectExpend', $user_permission) || in_array('viewProjectExpend', $user_permission) || in_array('deleteProjectExpend', $user_permission)): ?>
            <li class="treeview" id="mainProjectExpendNav">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span><?php echo $this->lang->line('Project Expenditure')?> </span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createProjectExpend', $user_permission)): ?>
                  <li id="addProjectExpendNav"><a href="<?php echo base_url('projectexpend/create') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Add Project Expenditure')?></a></li>
                <?php endif; ?>
                <?php if(in_array('updateProjectExpend', $user_permission) || in_array('viewProjectExpend', $user_permission) || in_array('deleteProjectExpend', $user_permission)): ?>
                <li id="manageProjectExpendNav"><a href="<?php echo base_url('projectexpend') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Manage Project Expenditure')?></a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>


          <?php if(in_array('createMaterials', $user_permission) || in_array('updateMaterials', $user_permission) || in_array('viewMaterials', $user_permission) || in_array('deleteMaterials', $user_permission)): ?>
            <li id="materialsNav">
              <a href="<?php echo base_url('materials/') ?>">
                <i class="fa fa-files-o"></i> <span><?php echo $this->lang->line('Materials Expenditure')?></span>
              </a>
            </li>
          <?php endif; ?>

          <?php if(in_array('createInvestExp', $user_permission) || in_array('updateInvestExp', $user_permission) || in_array('viewInvestExp', $user_permission) || in_array('deleteInvestExp', $user_permission)): ?>
            <li id="investexpNav">
              <a href="<?php echo base_url('investexp/') ?>">
                <i class="fa fa-files-o"></i> <span> <?php echo $this->lang->line('Invest Expenditure')?> </span>
              </a>
            </li>
          <?php endif; ?>

          <?php if(in_array('createTaxs',$user_permission) || in_array('updateTaxs',$user_permission) || in_array('viewTaxs',$user_permission) || in_array('deleteTaxs', $user_permission)): ?>
           <li id="taxsNav">
            <a href="<?php echo base_url('taxs/')?>">
              <i class="fa fa-files-o"></i> <span><?php echo $this->lang->line('Taxs')?></span>
            </a>
           </li>
           <?php endif;?>

          <!--<?php if(in_array('createStore', $user_permission) || in_array('updateStore', $user_permission) || in_array('viewStore', $user_permission) || in_array('deleteStore', $user_permission)): ?>
            <li id="storeNav">
              <a href="<?php echo base_url('stores/') ?>">
                <i class="fa fa-files-o"></i> <span><?php echo $this->lang->line('Stores')?></span>
              </a>
            </li>
          <?php endif; ?>-->

          <!--<?php if(in_array('createAttribute', $user_permission) || in_array('updateAttribute', $user_permission) || in_array('viewAttribute', $user_permission) || in_array('deleteAttribute', $user_permission)): ?>
          <li id="attributeNav">
            <a href="<?php echo base_url('attributes/') ?>">
              <i class="fa fa-files-o"></i> <span><?php echo $this->lang->line('Attributes')?> </span>
            </a>
          </li>
          <?php endif; ?>-->

          <?php if(in_array('createProduct', $user_permission) || in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
            <li class="treeview" id="mainProductNav">
              <a href="#">
                <i class="fa fa-cube"></i>
                <span><?php echo $this->lang->line('Products')?> </span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createProduct', $user_permission)): ?>
                  <li id="addProductNav"><a href="<?php echo base_url('products/create') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Add Product')?> </a></li>
                <?php endif; ?>
                <?php if(in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
                <li id="manageProductNav"><a href="<?php echo base_url('products') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Manage Products')?> </a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>


          <?php if(in_array('createOrder', $user_permission) || in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
            <li class="treeview" id="mainOrdersNav">
              <a href="#">
                <i class="fa fa-dollar"></i>
                <span><?php echo $this->lang->line('Orders')?> </span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createOrder', $user_permission)): ?>
                  <li id="addOrderNav"><a href="<?php echo base_url('orders/create') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Add Order')?></a></li>
                <?php endif; ?>
                <?php if(in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
                <li id="manageOrdersNav"><a href="<?php echo base_url('orders') ?>"><i class="fa fa-circle-o"></i> <?php echo $this->lang->line('Manage Orders')?> </a></li>
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

        

        <!-- <li class="header">Settings</li> -->

        <?php if(in_array('viewProfile', $user_permission)): ?>
          <li><a href="<?php echo base_url('users/profile/') ?>"><i class="fa fa-user-o"></i> <span><?php echo $this->lang->line('Profile')?> </span></a></li>
        <?php endif; ?>
        <?php if(in_array('updateSetting', $user_permission)): ?>
          <li><a href="<?php echo base_url('users/setting/') ?>"><i class="fa fa-wrench"></i> <span><?php echo $this->lang->line('Setting')?> </span></a></li>
        <?php endif; ?>

        <?php endif; ?>

        
        <!-- user permission info -->
        <li><a href="<?php echo base_url('auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> <span><?php echo $this->lang->line('Logout')?></span></a></li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>