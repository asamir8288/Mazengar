<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of branch
 *
 * @author Asamir
 */
class Branch extends CI_Controller {

    var $data = array();
    static $user_info = array();

    function __construct() {
        parent::__construct();

        self::$user_info = $this->session->userdata('user_info');
    }

    public function index() {
        $this->data['page_nav'] = '<li><a class="parent-breadcrumb" href="#">Create New Branch</a></li>';
        $this->data['page_title'] = 'Create New Branch';
        $this->data['top_menu'] = loggedinMenu('');
        $this->data['submit_url'] = site_url('branch');

        if ($this->input->post('submit')) {
            $posted_branch_data = $_POST;

            $b = new ShopBranches();
            $branch_id = $b->addBranch($posted_branch_data);

            $bf = new BranchFilters();
            for ($i = 0; $i < count($_POST['filter_id']); $i++) {
                $bf->addBranchFilter($branch_id, $_POST['filter_id'][$i]);
            }
            redirect(site_url('branch/manage_branches'));
        }

        $this->data['governates'] = LookupGovernoratesTable::listGovernorates();

        $m = new ShopMenuSubs();
        $menuTopLevel = $m->getMenuLevelOne(self::$user_info['shop_id'], 'branch');

        $this->data['menuTopLevel'] = $menuTopLevel;

        $s = new Shops();
        $category_id = $s->getShopCategoryId(self::$user_info['shop_id']);
        $this->data['filters'] = ShopCategoryFiltersTable::getCategoryFilters($category_id);

        $this->template->add_css('layout/css/form.css?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.tools.min.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/formvalidation.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/site_url_global.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/pages/branches.js?' . $this->config->item('static_version'));

        $this->template->add_js('layout/js/swfobject.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.uploadify.v2.1.4.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.livequery.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.reveal.js?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/uploadify.css?' . $this->config->item('static_version'));

        $this->template->add_css('layout/css/reveal.css?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/branches.css?' . $this->config->item('static_version'));

        $this->template->write_view('content', 'backend/branch', $this->data);
        $this->template->render();
    }

    public function manage_branches() {
        if ($this->input->post('submit')) {
            $order_branches = $_POST;
            Global_Functions::rearrangeItems($order_branches, 'ShopBranches', 'branch_order');
            redirect(site_url('branch/manage_branches'));
        }

        $this->data['page_nav'] = '<li><a  class="parent-breadcrumb" href="#">Branches</a></li>
                                   <li>/</li>
                                   <li><a href="#">Manage Branches</a></li>';
        $this->data['page_title'] = 'Manage Branches';
        $this->data['top_menu'] = loggedinMenu('');

        $info = session_data();
        $this->data['branches'] = ShopBranchesTable::getAllBranches($info['shop_id']);

        $this->template->add_js('layout/js/site_url_global.js?' . $this->config->item('static_version'));

        $this->template->add_js('layout/js/jquery.dragsort-0.5.1.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/pages/manage_branches.js?' . $this->config->item('static_version'));

        $this->template->write_view('content', 'backend/manage_branches', $this->data);
        $this->template->render();
    }

    public function get_collection($governate_id) {
        $this->data['collections'] = LookupCollectionsTable::getCollections($governate_id);
        $this->load->view('backend/lists/collections_list', $this->data);
    }

    public function edit($id) {
        $isMine = Global_Functions::isMine($id, self::$user_info['shop_id'], 'ShopBranches');
        if ($isMine == false) {
            redirect(site_url('branch/manage_branches'));
        }

        $b = new ShopBranches();
        $this->data['data'] = $b->getOne($id);

        $this->data['branch_menu'] = ShopMenuSubsTable::getProductMenu($this->data['data']['menu_id']);


        $this->data['page_nav'] = '<li><a class="parent-breadcrumb" href="#">Create New Branch</a></li>';
        $this->data['page_title'] = 'Create New Branch';
        $this->data['top_menu'] = loggedinMenu('');
        $this->data['submit_url'] = site_url('branch/edit/' . $id);

        if ($this->input->post('submit')) {
            $posted_branch_data = $_POST;
            $posted_branch_data['branch_id'] = $id;

            $b = new ShopBranches();
            $b->updateBranch($posted_branch_data);

            $bf = new BranchFilters();
            $bf->deleteBranchFilters($id);
            for ($i = 0; $i < count($_POST['filter_id']); $i++) {
                $bf->addBranchFilter($id, $_POST['filter_id'][$i]);
            }

            redirect(site_url('branch/manage_branches'));
        }

        $this->data['governates'] = LookupGovernoratesTable::listGovernorates();

        $m = new ShopMenuSubs();
        $menuTopLevel = $m->getMenuLevelOne(self::$user_info['shop_id'], 'branch');

        $this->data['menuTopLevel'] = $menuTopLevel;

        $s = new Shops();
        $category_id = $s->getShopCategoryId(self::$user_info['shop_id']);
        $this->data['filters'] = ShopCategoryFiltersTable::getCategoryFilters($category_id);

        $this->template->add_css('layout/css/form.css?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.tools.min.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/formvalidation.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/site_url_global.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/pages/branches.js?' . $this->config->item('static_version'));

        $this->template->add_js('layout/js/swfobject.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.uploadify.v2.1.4.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.livequery.js?' . $this->config->item('static_version'));
        $this->template->add_js('layout/js/jquery.reveal.js?' . $this->config->item('static_version'));

        $this->template->add_css('layout/css/uploadify.css?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/reveal.css?' . $this->config->item('static_version'));
        $this->template->add_css('layout/css/branches.css?' . $this->config->item('static_version'));

        $this->template->write_view('content', 'backend/branch', $this->data);
        $this->template->render();
    }

    public function activate_deactivate($branch_id) {
        $data = array();
        $sb = new ShopBranches();
        $data['status'] = $sb->activateDeactivate($branch_id);
        echo json_encode($data);
    }

    public function delete_branch($branch_id) {
        $sb = new ShopBranches();
        $sb->deleteBranch($branch_id);
        echo json_encode('success');
    }
}

?>
