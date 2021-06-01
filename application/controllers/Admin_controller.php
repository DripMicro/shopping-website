<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_controller extends Admin_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        //check user
        if (!is_admin()) {
            redirect(admin_url() . 'login');
        }
    }

    public function index()
    {
        $data['title'] = trans("admin_panel");

        $data['order_count'] = $this->order_admin_model->get_all_orders_count();
        $data['product_count'] = $this->product_admin_model->get_products_count();
        $data['pending_product_count'] = $this->product_admin_model->get_pending_products_count();
        $data['blog_posts_count'] = $this->blog_model->get_all_posts_count();
        $data['members_count'] = $this->auth_model->get_users_count_by_role('member');
        $data['latest_orders'] = $this->order_admin_model->get_orders_limited(15);
        $data['latest_pending_products'] = $this->product_admin_model->get_latest_pending_products(15);
        $data['latest_products'] = $this->product_admin_model->get_latest_products(15);
        

        $data['latest_reviews'] = $this->review_model->get_latest_reviews(15);
        $data['latest_comments'] = $this->comment_model->get_latest_comments(15);
        $data['latest_members'] = $this->auth_model->get_latest_members(6);
        $data['latest_transactions'] = $this->transaction_model->get_transactions_limited(15);
        $data['latest_promoted_transactions'] = $this->transaction_model->get_promoted_transactions_limited(15);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/index');
        $this->load->view('admin/includes/_footer');
    }

    /*
    * Navigation
    */
    public function navigation()
    {
        $data['title'] = trans("navigation");

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/navigation', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Navigation Post
     */
    public function navigation_post()
    {
        if ($this->settings_model->update_navigation()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /*
    * Homepage Manager
    */
    public function homepage_manager()
    {
        $data['title'] = trans("homepage_manager");
        $data['parent_categories'] = $this->category_model->get_parent_categories();
        $data['featured_categories'] = $this->category_model->get_featured_categories();
        $data['index_categories'] = $this->category_model->get_index_categories();
        $data['index_banners'] = $this->ad_model->get_index_banners_back_end();
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/homepage_manager/homepage_manager', $data);
        $this->load->view('admin/includes/_footer');
    }


    /*
    * Homepage Manager Post
    */
    public function homepage_manager_post()
    {
        $submit = $this->input->post('submit', true);
        if ($this->input->is_ajax_request()) {
            $category_id = $this->input->post('category_id', true);
        } else {
            $category_id = get_dropdown_category_id();
        }
        if ($submit == "featured_categories") {
            $this->category_model->set_unset_featured_category($category_id);
        }
        if ($submit == "products_by_category") {
            $this->category_model->set_unset_index_category($category_id);
        }
        reset_cache_data($this, "st");
        if (!$this->input->is_ajax_request()) {
            redirect($this->agent->referrer());
        }
    }






















    // -----------------------------------------------------------------------------------------

    public function pre_types()
    {
        $data['title'] = trans("pre_type");
        $data['pre_types'] = $this->predefine_model->get_type();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/predefine/type', $data);
        $this->load->view('admin/includes/_footer');
    }

    public function pre_categories()
    {
        $data['title'] = trans("pre_categories");
        $data['pre_categories'] = $this->predefine_model->get_categories();
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/predefine/categories', $data);
        $this->load->view('admin/includes/_footer');
    }

    public function pre_materials()
    {
        $data['title'] = trans("pre_materials");
        $data['pre_materials'] = $this->predefine_model->_get_materials();
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/predefine/materials', $data);
        $this->load->view('admin/includes/_footer');
    }

    public function pre_orientations()
    {
        $data['title'] = trans("pre_orientations");
        $data['pre_orientations'] = $this->predefine_model->get_orientations();
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/predefine/orientations', $data);
        $this->load->view('admin/includes/_footer');
    }

    public function pre_printsizes()
    {
        $data['title'] = trans("pre_print_size");
        $data['pre_materials'] = $this->predefine_model->get_materials();
        $data['pre_orientations'] = $this->predefine_model->get_orientations();

        $data['pre_printsizes'] = $this->predefine_model->get_printsizes();

        $data['category_id'] = $this->predefine_model->get_first_category();
        $data['product_id'] = $this->predefine_model->get_first_product();

        $data["custom_fields"] = $this->field_model->get_custom_fields_by_category($data['category_id']);
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/predefine/printsizes', $data);
        $this->load->view('admin/includes/_footer');
    }

    public function pre_finishoptions()
    {
        $data['title'] = trans("pre_finish_options");
        $data['pre_finishoptions'] = $this->predefine_model->get_finishoptions();
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/predefine/finishoptions', $data);
        $this->load->view('admin/includes/_footer');
    }

    public function pre_canvasdepths()
    {
        $data['title'] = trans("pre_canvas_depth");
        $data['pre_canvasdepths'] = $this->predefine_model->get_canvasdepths();
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/predefine/canvasdepths', $data);
        $this->load->view('admin/includes/_footer');
    }

    public function pre_framestyles()
    {
        $data['title'] = trans("pre_frame_style");
        $data['pre_materials'] = $this->predefine_model->get_materials();
        $data['pre_framestyles'] = $this->predefine_model->get_framestyles();
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/predefine/framestyles', $data);
        $this->load->view('admin/includes/_footer');
    }

    public function pre_minmaxsettings()
    {
        $data['title'] = trans("pre_min_max_setting");
        $data['price_value'] = $this->predefine_model->get_minmaxprice();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/predefine/minmaxsettings', $data);
        $this->load->view('admin/includes/_footer');
    }

    /*
    * Predefine Setting add type Post
    */
    public function predefine_setting_add_type_post()
    {
        $type = $this->input->post('add_type', true);
        $this->predefine_model->add_type_post($type);
        $this->session->set_flashdata('success', trans("msg_updated"));
        $this->session->set_flashdata('msg_settings', 1);
        redirect($this->agent->referrer());
    }

    /**
     * Update Predefine Type
     */
    public function update_pre_type($id)
    {
        $data['title'] = trans("type");
        //get item
        $data['item'] = $this->predefine_model->get_type_item($id);

        if (empty($data['item'])) {
            redirect($this->agent->referrer());
        }
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/predefine/update_type', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update Type Item Post
     */
    public function update_type_item_post()
    {
        //item id
        $id = $this->input->post('id', true);
        if ($this->predefine_model->update_type_item($id)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect(admin_url() . 'pre-types');
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Delete Type Item Post
     */
    public function delete_type_item_post()
    {
        $id = $this->input->post('id', true);
        if ($this->predefine_model->delete_type_item($id)) {
            $this->session->set_flashdata('success', trans("msg_item_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

// -----------------------------------------------------------------------------------------

/*
    * Predefine Setting add categories Post
    */
    public function predefine_setting_add_categories_post()
    {
        $categories = $this->input->post('add_categories', true);
        $this->predefine_model->add_categories_post($categories);
        $this->session->set_flashdata('success', trans("msg_updated"));
        $this->session->set_flashdata('msg_settings', 1);
        redirect($this->agent->referrer());
    }

    /**
     * Update Predefine categories
     */
    public function update_pre_categories($id)
    {
        $data['title'] = trans("categories");
        //get item
        $data['item'] = $this->predefine_model->get_categories_item($id);

        if (empty($data['item'])) {
            redirect($this->agent->referrer());
        }
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/predefine/update_categories', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update categories Item Post
     */
    public function update_categories_item_post()
    {
        //item id
        $id = $this->input->post('id', true);
        if ($this->predefine_model->update_categories_item($id)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect(admin_url() . 'pre-categories');
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Delete categories Item Post
     */
    public function delete_categories_item_post()
    {
        $id = $this->input->post('id', true);
        if ($this->predefine_model->delete_categories_item($id)) {
            $this->session->set_flashdata('success', trans("msg_item_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

    //  --------------------------------------

    // -----------------------------------------------------------------------------------------

/*
    * Predefine Setting add materials Post
    */
    public function predefine_setting_add_materials_post()
    {
        $materials = $this->input->post('add_materials', true);
        // $price = $this->input->post('add_price', true);
        $this->predefine_model->add_materials_post($materials);
        $this->session->set_flashdata('success', trans("msg_updated"));
        $this->session->set_flashdata('msg_settings', 1);
        redirect($this->agent->referrer());
    }

    /**
     * Update Predefine materials
     */
    public function update_pre_materials($id)
    {
        $data['title'] = trans("materials");
        //get item
        $data['item'] = $this->predefine_model->get_materials_item($id);

        if (empty($data['item'])) {
            redirect($this->agent->referrer());
        }
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/predefine/update_materials', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update materials Item Post
     */
    public function predefine_setting_update_status_post()
    {
        //item id
        $id = $this->input->post('id', true);
        $status = $this->input->post('status', true);

        $status = $status==1?0:1;
        if ($this->predefine_model->update_materials_item_status($id, $status)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect(admin_url() . 'pre-materials');
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Update materials Item Post
     */
    public function update_materials_item_post()
    {
        //item id
        $id = $this->input->post('id', true);
        if ($this->predefine_model->update_materials_item($id)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect(admin_url() . 'pre-materials');
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Delete materials Item Post
     */
    public function delete_materials_item_post()
    {
        $id = $this->input->post('id', true);
        if ($this->predefine_model->delete_materials_item($id)) {
            $this->session->set_flashdata('success', trans("msg_item_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

    //  --------------------------------------


    // -----------------------------------------------------------------------------------------

/*
    * Predefine Setting add orientations Post
    */
    public function predefine_setting_add_orientations_post()
    {
        $orientations = $this->input->post('add_orientations', true);
        $this->predefine_model->add_orientations_post($orientations);
        $this->session->set_flashdata('success', trans("msg_updated"));
        $this->session->set_flashdata('msg_settings', 1);
        redirect($this->agent->referrer());
    }

    /**
     * Update Predefine orientations
     */
    public function update_pre_orientations($id)
    {
        $data['title'] = trans("orientations");
        //get item
        $data['item'] = $this->predefine_model->get_orientations_item($id);

        if (empty($data['item'])) {
            redirect($this->agent->referrer());
        }
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/predefine/update_orientations', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update orientations Item Post
     */
    public function update_orientations_item_post()
    {
        //item id
        $id = $this->input->post('id', true);
        if ($this->predefine_model->update_orientations_item($id)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect(admin_url() . 'pre-orientations');
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Delete orientations Item Post
     */
    public function delete_orientations_item_post()
    {
        $id = $this->input->post('id', true);
        if ($this->predefine_model->delete_orientations_item($id)) {
            $this->session->set_flashdata('success', trans("msg_item_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

    //  --------------------------------------


     // -----------------------------------------------------------------------------------------

/*
    * Predefine Setting add printsizes Post
    */
    public function predefine_setting_add_printsizes_post()
    {
        $material_id = $this->input->post('material', true);
        $orientation_id = $this->input->post('orientation', true);
        $printsizes = $this->input->post('add_printsize', true);
        $price = $this->input->post('add_price', true);
        $this->predefine_model->add_printsizes_post($material_id, $orientation_id, $printsizes, $price);
        $this->session->set_flashdata('success', trans("msg_updated"));
        $this->session->set_flashdata('msg_settings', 1);
        redirect($this->agent->referrer());
    }

    /**
     * Update Predefine printsizes
     */
    public function update_pre_printsizes($id)
    {
        $data['title'] = trans("pre_print_size");
        //get item
        $data['item'] = $this->predefine_model->get_printsizes_item($id);
        $data['materials'] = $this->predefine_model->get_materials();
        $data['orientations'] = $this->predefine_model->get_orientations();

        $data['category_id'] = $this->predefine_model->get_first_category();
        $data['product_id'] = $this->predefine_model->get_first_product();

        $data["custom_fields"] = $this->field_model->get_custom_fields_by_category($data['category_id']);
        
        if (empty($data['item'])) {
            redirect($this->agent->referrer());
        }
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/predefine/update_printsizes', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update printsizes Item Post
     */
    public function update_printsizes_item_post()
    {
        //item id
        $id = $this->input->post('id', true);
        if ($this->predefine_model->update_printsizes_item($id)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect(admin_url() . 'pre-printsizes');
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Update printsizes Item Post
     */
    public function predefine_printsizes_update_status_post()
    {
        //item id
        $id = $this->input->post('id', true);
        $status = $this->input->post('status', true);

        $status = $status==1?0:1;
        if ($this->predefine_model->update_printsizes_item_status($id, $status)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect(admin_url() . 'pre-printsizes');
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Delete printsizes Item Post
     */
    public function delete_printsizes_item_post()
    {
        $id = $this->input->post('id', true);
        if ($this->predefine_model->delete_printsizes_item($id)) {
            $this->session->set_flashdata('success', trans("msg_item_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

    //  --------------------------------------

// -----------------------------------------------------------------------------------------

/*
    * Predefine Setting add finishoptions Post
    */
    public function predefine_setting_add_finishoptions_post()
    {
        $finishoptions = $this->input->post('add_finishoptions', true);
        $price = $this->input->post('add_price', true);
        $this->predefine_model->add_finishoptions_post($finishoptions, $price);
        $this->session->set_flashdata('success', trans("msg_updated"));
        $this->session->set_flashdata('msg_settings', 1);
        redirect($this->agent->referrer());
    }

    /**
     * Update Predefine finishoptions
     */
    public function update_pre_finishoptions($id)
    {
        $data['title'] = trans("pre_finish_options");
        //get item
        $data['item'] = $this->predefine_model->get_finishoptions_item($id);

        if (empty($data['item'])) {
            redirect($this->agent->referrer());
        }
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/predefine/update_finishoptions', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update finishoptions Item Post
     */
    public function update_finishoptions_item_post()
    {
        //item id
        $id = $this->input->post('id', true);
        if ($this->predefine_model->update_finishoptions_item($id)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect(admin_url() . 'pre-finishoptions');
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Update finishoptions Item Post
     */
    public function predefine_finishoptions_update_status_post()
    {
        //item id
        $id = $this->input->post('id', true);
        $status = $this->input->post('status', true);

        $status = $status==1?0:1;
        if ($this->predefine_model->update_finishoptions_item_status($id, $status)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect(admin_url() . 'pre-finishoptions');
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Delete finishoptions Item Post
     */
    public function delete_finishoptions_item_post()
    {
        $id = $this->input->post('id', true);
        if ($this->predefine_model->delete_finishoptions_item($id)) {
            $this->session->set_flashdata('success', trans("msg_item_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

    //  --------------------------------------


    // -----------------------------------------------------------------------------------------

/*
    * Predefine Setting add canvasdepths Post
    */
    public function predefine_setting_add_canvasdepths_post()
    {
        $canvasdepths = $this->input->post('add_canvasdepths', true);
        $price = $this->input->post('add_price', true);
        $this->predefine_model->add_canvasdepths_post($canvasdepths, $price);
        $this->session->set_flashdata('success', trans("msg_updated"));
        $this->session->set_flashdata('msg_settings', 1);
        redirect($this->agent->referrer());
    }

    /**
     * Update Predefine canvasdepths
     */
    public function update_pre_canvasdepths($id)
    {
        $data['title'] = trans("pre_finish_options");
        //get item
        $data['item'] = $this->predefine_model->get_canvasdepths_item($id);

        if (empty($data['item'])) {
            redirect($this->agent->referrer());
        }
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/predefine/update_canvasdepths', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update canvasdepths Item Post
     */
    public function update_canvasdepths_item_post()
    {
        //item id
        $id = $this->input->post('id', true);
        if ($this->predefine_model->update_canvasdepths_item($id)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect(admin_url() . 'pre-canvasdepths');
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Update canvasdepths Item Post
     */
    public function predefine_canvasdepths_update_status_post()
    {
        //item id
        $id = $this->input->post('id', true);
        $status = $this->input->post('status', true);

        $status = $status==1?0:1;
        if ($this->predefine_model->update_canvasdepths_item_status($id, $status)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect(admin_url() . 'pre-canvasdepths');
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Delete canvasdepths Item Post
     */
    public function delete_canvasdepths_item_post()
    {
        $id = $this->input->post('id', true);
        if ($this->predefine_model->delete_canvasdepths_item($id)) {
            $this->session->set_flashdata('success', trans("msg_item_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

    //  --------------------------------------


    // -----------------------------------------------------------------------------------------

/*
    * Predefine Setting add framestyles Post
    */
    public function predefine_setting_add_framestyles_post()
    {
        $material_id = $this->input->post('material', true);
        $framestyles = $this->input->post('add_framestyles', true);
        $price = $this->input->post('add_price', true);
        $this->predefine_model->add_framestyles_post($material_id, $framestyles, $price);
        $this->session->set_flashdata('success', trans("msg_updated"));
        $this->session->set_flashdata('msg_settings', 1);
        redirect($this->agent->referrer());
    }

    /**
     * Update Predefine framestyles
     */
    public function update_pre_framestyles($id)
    {
        $data['title'] = trans("pre_frame_style");
        $data['materials'] = $this->predefine_model->get_materials();
        //get item
        $data['item'] = $this->predefine_model->get_framestyles_item($id);

        if (empty($data['item'])) {
            redirect($this->agent->referrer());
        }
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/predefine/update_framestyles', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update framestyles Item Post
     */
    public function predefine_framestyles_update_status_post()
    {
        //item id
        $id = $this->input->post('id', true);
        $status = $this->input->post('status', true);

        $status = $status==1?0:1;
        if ($this->predefine_model->update_framestyles_item_status($id, $status)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect(admin_url() . 'pre-framestyles');
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Update framestyles Item Post
     */
    public function update_framestyles_item_post()
    {
        //item id
        $id = $this->input->post('id', true);
        if ($this->predefine_model->update_framestyles_item($id)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect(admin_url() . 'pre-framestyles');
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Delete framestyles Item Post
     */
    public function delete_framestyles_item_post()
    {
        $id = $this->input->post('id', true);
        if ($this->predefine_model->delete_framestyles_item($id)) {
            $this->session->set_flashdata('success', trans("msg_item_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

    //  --------------------------------------

    /**
     * Update Predefine minmaxsettings
     */
    public function update_pre_minmaxsettings($id)
    {
        $data['title'] = trans("pre_min_max_setting");
        //get item
        $data['price_value'] = $this->predefine_model->get_minmaxprice();

        if (empty($data['price_value'])) {
            redirect($this->agent->referrer());
        }
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/predefine/update_minmaxsettings', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Update minmaxsettings Item Post
     */
    public function update_minmaxsettings_item_post()
    {
        //item id
        if ($this->predefine_model->update_minmaxsettings_item('1')) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect(admin_url() . 'pre-minmaxsettings');
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    //  --------------------------------------


    /*
    * Homepage Manager Settings Post
    */
    public function homepage_manager_settings_post()
    {
        $this->settings_model->update_homepage_manager_settings();
        $this->session->set_flashdata('success', trans("msg_updated"));
        $this->session->set_flashdata('msg_settings', 1);
        redirect($this->agent->referrer() . "#product_settings");
    }

    /*
    * Add Index Banner Post
    */
    public function add_index_banner_post()
    {
        if ($this->ad_model->add_index_banner()) {
            $this->session->set_flashdata('success', trans("msg_added"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        $this->session->set_flashdata('msg_banner', 1);
        redirect($this->agent->referrer() . "#form_banners");
    }


    /*
    * Edit Index Banner
    */
    public function edit_index_banner($id)
    {
        $data['title'] = trans("edit_banner");
        //get category
        $data['banner'] = $this->ad_model->get_index_banner($id);
        if (empty($data['banner'])) {
            redirect($this->agent->referrer());
        }

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/homepage_manager/edit_banner', $data);
        $this->load->view('admin/includes/_footer');
    }


    /*
    * Edit Index Banner Post
    */
    public function edit_index_banner_post()
    {
        $id = $this->input->post('id', true);
        if ($this->ad_model->edit_index_banner($id)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }

    /*
    * Delete Index Banner Post
    */
    public function delete_index_banner_post()
    {
        $id = $this->input->post('id', true);
        $this->ad_model->delete_index_banner($id);
    }

    /*
    * Slider
    */
    public function slider()
    {
        $data['title'] = trans("slider_items");
        $data['slider_items'] = $this->slider_model->get_slider_items_all();
        $data['lang_search_column'] = 3;
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/slider/slider', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Add Slider Item Post
     */
    public function add_slider_item_post()
    {
        if ($this->slider_model->add_item()) {
            $this->session->set_flashdata('success_form', trans("msg_slider_added"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error_form', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Update Slider Item
     */
    public function update_slider_item($id)
    {
        $data['title'] = trans("update_slider_item");
        //get item
        $data['item'] = $this->slider_model->get_slider_item($id);

        if (empty($data['item'])) {
            redirect($this->agent->referrer());
        }
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/slider/update_slider', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Slider Item Post
     */
    public function update_slider_item_post()
    {
        //item id
        $id = $this->input->post('id', true);
        if ($this->slider_model->update_item($id)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect(admin_url() . 'slider');
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Update Slider Settings Post
     */
    public function update_slider_settings_post()
    {
        if ($this->slider_model->update_slider_settings()) {
            $this->session->set_flashdata('success_form', trans("msg_updated"));
            $this->session->set_flashdata('msg_settings', 1);
        } else {
            $this->session->set_flashdata('error_form', trans("msg_error"));
            $this->session->set_flashdata('msg_settings', 1);
        }
        redirect($this->agent->referrer());
    }

    /**
     * Delete Slider Item Post
     */
    public function delete_slider_item_post()
    {
        $id = $this->input->post('id', true);
        if ($this->slider_model->delete_slider_item($id)) {
            $this->session->set_flashdata('success', trans("msg_slider_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

    /*
    *-------------------------------------------------------------------------------------------------
    * BIDDING SYSTEM
    *-------------------------------------------------------------------------------------------------
    */

    /**
     * Quote Requests
     */
    public function quote_requests()
    {
        $this->load->model('bidding_model');
        $data['title'] = trans("quote_requests");
        $data['form_action'] = admin_url() . "quote-requests";
        
        //get paginated requests
        $pagination = $this->paginate(admin_url() . 'quote-requests', $this->bidding_model->get_admin_quote_requests_count());
        $data['quote_requests'] = $this->bidding_model->get_admin_paginated_quote_requests($pagination['per_page'], $pagination['offset']);
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/bidding/quote_requests', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Delete Quote Request
     */
    public function delete_quote_request_post()
    {
        $this->load->model('bidding_model');
        $id = $this->input->post('id', true);
        if ($this->bidding_model->delete_admin_quote_request($id)) {
            $this->session->set_flashdata('success', trans("msg_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }


    /*
    *-------------------------------------------------------------------------------------------------
    * NEWSLETTER
    *-------------------------------------------------------------------------------------------------
    */

    /**
     * Send Email to Subscribers
     */
    public function send_email_subscribers()
    {
        $data['title'] = trans("send_email_subscribers");
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/newsletter/send_email', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Newsletter Send Email Post
     */
    public function send_email_subscribers_post()
    {
        $this->load->model("email_model");

        $subject = $this->input->post('subject', true);
        $message = $this->input->post('message', false);

        $data['subscribers'] = $this->newsletter_model->get_subscribers();
        $result = false;
        if (!empty($data['subscribers'])) {
            $result = true;
            foreach ($data['subscribers'] as $item) {
                //send email
                if (!$this->email_model->send_email_newsletter($item, $subject, $message)) {
                    $result = false;
                }
            }
        }

        if ($result == true) {
            $this->session->set_flashdata('success', trans("msg_email_sent"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }


    /**
     * Subscribers
     */
    public function subscribers()
    {
        $data['title'] = trans("subscribers");
        $data['subscribers'] = $this->newsletter_model->get_subscribers();
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/newsletter/subscribers', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Delete Subscriber Post
     */
    public function delete_subscriber_post()
    {
        $id = $this->input->post('id', true);

        $data['subscriber'] = $this->newsletter_model->get_subscriber_by_id($id);

        if (empty($data['subscriber'])) {
            redirect($this->agent->referrer());
        }

        if ($this->newsletter_model->delete_from_subscribers($id)) {
            $this->session->set_flashdata('success', trans("msg_subscriber_deleted"));
            $this->session->set_flashdata("mes_subscriber_delete", 1);
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            $this->session->set_flashdata("mes_subscriber_delete", 1);
        }
    }


    /**
     * Contact Messages
     */
    public function contact_messages()
    {
        $data['title'] = trans("contact_messages");

        $data['messages'] = $this->contact_model->get_contact_messages();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/contact_messages', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Delete Contact Message Post
     */
    public function delete_contact_message_post()
    {
        $id = $this->input->post('id', true);

        if ($this->contact_model->delete_contact_message($id)) {
            $this->session->set_flashdata('success', trans("msg_message_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

    /**
     * Ads
     */
    public function ad_spaces()
    {
        $data['title'] = trans("ad_spaces");

        $data['ad_space'] = $this->input->get('ad_space', true);

        if (empty($data['ad_space'])) {
            redirect(admin_url() . "ad-spaces?ad_space=index_1");
        }

        $data['ad_codes'] = $this->ad_model->get_ad_codes($data['ad_space']);
        if (empty($data['ad_codes'])) {
            redirect(admin_url() . "ad-spaces");
        }
        
        $data["array_ad_spaces"] = array(
            "index_1" => trans("index_ad_space_1"),
            "index_2" => trans("index_ad_space_2"),
            "products" => trans("products_ad_space"),
            "products_sidebar" => trans("products_sidebar_ad_space"),
            "product" => trans("product_ad_space"),
            "product_bottom" => trans("product_bottom_ad_space"),
            "blog_1" => trans("blog_ad_space_1"),
            "blog_2" => trans("blog_ad_space_2"),
            "blog_post_details" => trans("blog_post_details_ad_space"),
            "blog_post_details_sidebar" => trans("blog_post_details_sidebar_ad_space"),
            "profile" => trans("profile_ad_space"),
            "profile_sidebar" => trans("profile_sidebar_ad_space"),
        );

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/ad_spaces', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Ads Post
     */
    public function ad_spaces_post()
    {
        $ad_space = $this->input->post('ad_space', true);

        if ($this->ad_model->update_ad_spaces($ad_space)) {
            reset_cache_data($this, "st");
            $this->session->set_flashdata('success', trans("msg_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }

    /**
     * Google Adsense Code Post
     */
    public function google_adsense_code_post()
    {
        if ($this->ad_model->update_google_adsense_code()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            $this->session->set_flashdata('mes_adsense', 1);
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            $this->session->set_flashdata('mes_adsense', 1);
        }
        redirect($this->agent->referrer());
    }

    /*
    * Seo Tools
    */
    public function seo_tools()
    {
        $data['title'] = trans("seo_tools");
        $data["current_lang_id"] = $this->input->get("lang", true);

        if (empty($data["current_lang_id"])) {
            $data["current_lang_id"] = $this->general_settings->site_lang;
            redirect(admin_url() . "seo-tools?lang=" . $data["current_lang_id"]);
        }
        
        $data['settings'] = $this->settings_model->get_settings($data["current_lang_id"]);
        $data['languages'] = $this->language_model->get_languages();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/seo_tools', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Seo Tools Post
     */
    public function seo_tools_post()
    {
        if ($this->settings_model->update_seo_tools()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }


    /*
    *-------------------------------------------------------------------------------------------------
    * CURRENCY SETTINGS
    *-------------------------------------------------------------------------------------------------
    */


    /*
    * Currency Settings
    */
    public function currency_settings()
    {
        $data['title'] = trans("currency_settings");
        $data['currencies'] = $this->currency_model->get_currencies();
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/currency/currency_settings', $data);
        $this->load->view('admin/includes/_footer');
    }

    /*
    * Currency Settings Post
    */
    public function currency_settings_post()
    {
        if ($this->currency_model->update_currency_settings()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        $this->session->set_flashdata('msg_settings', 1);
        redirect($this->agent->referrer());
    }

    /*
    * Currency Converter Post
    */
    public function currency_converter_post()
    {
        if ($this->currency_model->update_currency_converter_settings()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        $this->session->set_flashdata('msg_converter', 1);
        redirect($this->agent->referrer());
    }

    /**
     * Add Currency
     */
    public function add_currency()
    {
        $data['title'] = trans("add_currency");
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/currency/add_currency', $data);
        $this->load->view('admin/includes/_footer');
    }

    /*
    * Add Currency Post
    */
    public function add_currency_post()
    {
        if ($this->currency_model->add_currency()) {
            $this->session->set_flashdata('msg_add', 1);
            $this->session->set_flashdata('success', trans("msg_added"));
        } else {
            $this->session->set_flashdata('msg_add', 1);
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }

    /**
     * Update Currency
     */
    public function update_currency($id)
    {
        $data['title'] = trans("update_currency");

        $data['currency'] = $this->currency_model->get_currency($id);

        //page not found
        if (empty($data['currency'])) {
            redirect($this->agent->referrer());
        }

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/currency/update_currency', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Edit Currency Rate
     */
    public function edit_currency_rate()
    {
        $this->currency_model->edit_currency_rate();
    }

    /**
     * Update Currency Post
     */
    public function update_currency_post()
    {
        $id = $this->input->post('id', true);

        if ($this->currency_model->update_currency($id)) {
            $this->session->set_flashdata('msg_table', 1);
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect(admin_url() . "currency-settings");
        } else {
            $this->session->set_flashdata('msg_table', 1);
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    // Update Currency Rates
    public function update_currency_rates()
    {
        if ($this->currency_model->update_currency_rates()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        $this->session->set_flashdata('msg_table', 1);
        redirect($this->agent->referrer());
    }

    /*
    * Delete Currency Post
    */
    public function delete_currency_post()
    {
        $id = $this->input->post('id', true);
        if ($this->currency_model->delete_currency($id)) {
            $this->session->set_flashdata('msg_table', 1);
            $this->session->set_flashdata('success', trans("msg_deleted"));
        } else {
            $this->session->set_flashdata('msg_table', 1);
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }


    /*
    *-------------------------------------------------------------------------------------------------
    * ABUSE REPORTS
    *-------------------------------------------------------------------------------------------------
    */

    /**
     * Abuse Reports
     */
    public function abuse_reports()
    {
        $data['title'] = trans("abuse_reports");

        $data['num_rows'] = $this->review_model->get_abuse_reports_count();
        $pagination = $this->paginate(admin_url() . "abuse-reports", $data['num_rows']);
        $data['abuse_reports'] = $this->review_model->get_paginated_abuse_reports($pagination['per_page'], $pagination['offset']);
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/abuse_reports', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Delete Abuse Report
     */
    public function delete_abuse_report_post()
    {
        $id = $this->input->post('id', true);
        if ($this->review_model->delete_abuse_report($id)) {
            $this->session->set_flashdata('success', trans("msg_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }


    /*
    *-------------------------------------------------------------------------------------------------
    * EMAIL SETTINGS
    *-------------------------------------------------------------------------------------------------
    */

    /*
    * Email Settings
    */
    public function email_settings()
    {
        $data['title'] = trans("email_settings");

        $data['general_settings'] = $this->settings_model->get_general_settings();
        
        $data["library"] = $this->input->get('library');
        if (empty($data["library"])) {
            $data["library"] = "swift";
            if (!empty($this->general_settings->mail_library)) {
                $data["library"] = $this->general_settings->mail_library;
            }
            redirect(admin_url() . "email-settings?library=" . $data["library"]);
        }

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/settings/email_settings', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Email Settings Post
     */
    public function email_settings_post()
    {
        if ($this->settings_model->update_email_settings()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            $this->session->set_flashdata('submit', $this->input->post('submit', true));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            $this->session->set_flashdata('submit', $this->input->post('submit', true));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Email Verification Post
     */
    public function email_verification_post()
    {
        if ($this->settings_model->update_email_verification()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            $this->session->set_flashdata('submit', "verification");
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            $this->session->set_flashdata('submit', "verification");
            redirect($this->agent->referrer());
        }
    }

    /**
     * Email Options Post
     */
    public function email_options_post()
    {
        if ($this->settings_model->update_email_options()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            $this->session->set_flashdata('submit', "options");
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            $this->session->set_flashdata('submit', "options");
            redirect($this->agent->referrer());
        }
    }

    /**
     * Send Test Email Post
     */
    public function send_test_email_post()
    {
        $email = $this->input->post('email', true);
        $subject = "Modesy Test Email";
        $message = "<p>This is a test email.</p>";
        $this->load->model("email_model");
        $this->session->set_flashdata('submit', "send_email");
        if (!empty($email)) {
            if (!$this->email_model->send_test_email($email, $subject, $message)) {
                redirect($this->agent->referrer());
                exit();
            }
            $this->session->set_flashdata('success', trans("msg_email_sent"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }

    /*
    *-------------------------------------------------------------------------------------------------
    * FORM SETTINGS
    *-------------------------------------------------------------------------------------------------
    */

    /*
    * Visual Settings
    */
    public function visual_settings()
    {
        $data['title'] = trans("visual_settings");
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/settings/visual_settings', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Visual Settings Post
     */
    public function visual_settings_post()
    {
        if ($this->settings_model->update_visual_settings()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }

    /**
     * Update Watermak Category
     */
    public function update_watermark_settings_post()
    {
        $this->settings_model->update_watermark_settings();
        redirect($this->agent->referrer());
    }

    /**
     * Delete Category Watermak
     */
    public function delete_category_watermark_post()
    {
        $this->settings_model->delete_category_watermark();
        redirect($this->agent->referrer());
    }


    /*
    * System Settings
    */
    public function system_settings()
    {
        $data['title'] = trans("system_settings");
        
        $data['system_settings'] = $this->settings_model->get_system_settings();
        $data['currencies'] = $this->currency_model->get_currencies();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/settings/system_settings', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * System Settings Post
     */
    public function system_settings_post()
    {
        //check product type
        $physical_products_system = $this->input->post('physical_products_system', true);
        $digital_products_system = $this->input->post('digital_products_system', true);
        if ($physical_products_system == 0 && $digital_products_system == 0) {
            $this->session->set_flashdata('error', trans("msg_error_product_type"));
            redirect($this->agent->referrer());
            exit();
        }

        $marketplace_system = $this->input->post('marketplace_system', true);
        $classified_ads_system = $this->input->post('classified_ads_system', true);
        $bidding_system = $this->input->post('bidding_system', true);
        if ($marketplace_system == 0 && $classified_ads_system == 0 && $bidding_system == 0) {
            $this->session->set_flashdata('error', trans("msg_error_selected_system"));
            redirect($this->agent->referrer());
            exit();
        }

        if ($this->settings_model->update_system_settings()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }


    /*
    * Social Login Settings
    */
    public function social_login_settings()
    {
        $data['title'] = trans("social_login");
        
        $data['general_settings'] = $this->settings_model->get_general_settings();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/settings/social_login', $data);
        $this->load->view('admin/includes/_footer');
    }

    /**
     * Facebook Login Post
     */
    public function facebook_login_post()
    {
        if ($this->settings_model->update_facebook_login()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            $this->session->set_flashdata("mes_social_facebook", 1);
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            $this->session->set_flashdata("mes_social_facebook", 1);
            redirect($this->agent->referrer());
        }
    }

    /**
     * Google Login Post
     */
    public function google_login_post()
    {
        if ($this->settings_model->update_google_login()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            $this->session->set_flashdata("mes_social_google", 1);
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            $this->session->set_flashdata("mes_social_google", 1);
            redirect($this->agent->referrer());
        }
    }

    /**
     * Google Login Post
     */
    public function social_login_vk_post()
    {
        if ($this->settings_model->update_vk_login()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            $this->session->set_flashdata("mes_social_vk", 1);
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            $this->session->set_flashdata("mes_social_vk", 1);
            redirect($this->agent->referrer());
        }
    }

    /**
     * Storage
     */
    public function storage()
    {
        $data['title'] = trans("storage");
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/storage', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Storage Post
     */
    public function storage_post()
    {
        if ($this->settings_model->update_storage_settings()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }

    /**
     * AWS S3 Post
     */
    public function aws_s3_post()
    {
        if ($this->settings_model->update_aws_s3()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            $this->session->set_flashdata('mes_s3', 1);
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }

    /**
     * Cache System
     */
    public function cache_system()
    {
        $data['title'] = trans("cache_system");
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/cache_system', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Product Cache System Post
     */
    public function product_cache_system_post()
    {
        if ($this->input->post('action', true) == "reset") {
            reset_cache_data($this, "pr", true);
            $this->session->set_flashdata('success', trans("msg_reset_cache"));
        } else {
            if ($this->settings_model->update_product_cache_system()) {
                $this->session->set_flashdata('success', trans("msg_updated"));
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
            }
        }
        redirect($this->agent->referrer());
    }

    /**
     * Static Content Cache System Post
     */
    public function static_content_cache_system_post()
    {
        if ($this->input->post('action', true) == "reset") {
            reset_cache_data($this, "st", true);
            $this->session->set_flashdata('success', trans("msg_reset_cache"));
        } else {
            if ($this->settings_model->update_static_content_cache_system()) {
                $this->session->set_flashdata('success', trans("msg_updated"));
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
            }
        }
        $this->session->set_flashdata('msg_category', 1);
        redirect($this->agent->referrer());
    }

    /**
     * Preferences
     */
    public function preferences()
    {
        $data['title'] = trans("preferences");
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/preferences', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Preferences Post
     */
    public function preferences_post()
    {
        $form = $this->input->post('submit', true);
        $this->session->set_flashdata('mes_' . $form, 1);
        if ($this->settings_model->update_preferences($form)) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            //reset cache
            redirect(admin_url() . "preferences");
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }


    /*
     * Settings
     */
    public function settings()
    {
        $data['title'] = trans("settings");

        $data["settings_lang"] = $this->input->get("lang", true);
        if (empty($data["settings_lang"])) {
            $data["settings_lang"] = $this->selected_lang->id;
            redirect(admin_url() . "settings?lang=" . $data["settings_lang"]);
        }
        
        $data['settings'] = $this->settings_model->get_settings($data["settings_lang"]);
        $data['general_settings'] = $this->settings_model->get_general_settings();
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/settings/settings', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Settings Post
     */
    public function settings_post()
    {
        if ($this->settings_model->update_settings()) {
            $this->settings_model->update_general_settings();
            $this->session->set_flashdata('success', trans("msg_updated"));
            $this->session->set_flashdata("mes_settings", 1);
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            $this->session->set_flashdata("mes_settings", 1);
            redirect($this->agent->referrer());
        }
    }


    /**
     * Recaptcha Settings Post
     */
    public function recaptcha_settings_post()
    {
        if ($this->settings_model->update_recaptcha_settings()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            $this->session->set_flashdata("mes_recaptcha", 1);
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            $this->session->set_flashdata("mes_recaptcha", 1);
            redirect($this->agent->referrer());
        }
    }

    /**
     * Maintenance Mode Post
     */
    public function maintenance_mode_post()
    {
        if ($this->settings_model->update_maintenance_mode_settings()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            $this->session->set_flashdata("mes_maintenance", 1);
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            $this->session->set_flashdata("mes_maintenance", 1);
            redirect($this->agent->referrer());
        }
    }

    /*
    *-------------------------------------------------------------------------------------------------
    * LOCATION
    *-------------------------------------------------------------------------------------------------
    */

    /**
     * Countries
     */
    public function countries()
    {
        $data['title'] = trans("countries");
        //get paginated products
        $pagination = $this->paginate(admin_url() . 'countries', $this->location_model->get_paginated_countries_count());
        $data['countries'] = $this->location_model->get_paginated_countries($pagination['per_page'], $pagination['offset']);
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/location/countries', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add Country
     */
    public function add_country()
    {
        $data['title'] = trans("add_country");

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/location/add_country', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add Country Post
     */
    public function add_country_post()
    {
        //validate inputs
        $this->form_validation->set_rules('name', trans("name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {
            if ($this->location_model->add_country()) {
                reset_cache_data($this, "st");
                $this->session->set_flashdata('success', trans("msg_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update Country
     */
    public function update_country($id)
    {
        $data['title'] = trans("update_country");

        //get country
        $data['country'] = $this->location_model->get_country($id);
        if (empty($data['country'])) {
            redirect($this->agent->referrer());
        }

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/location/update_country', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Country Post
     */
    public function update_country_post()
    {
        //validate inputs
        $this->form_validation->set_rules('name', trans("name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {
            //country id
            $id = $this->input->post('id', true);
            if ($this->location_model->update_country($id)) {
                reset_cache_data($this, "st");
                $this->session->set_flashdata('success', trans("msg_updated"));
                redirect(admin_url() . 'countries');
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Delete Country Post
     */
    public function delete_country_post()
    {
        $id = $this->input->post('id', true);
        if ($this->location_model->delete_country($id)) {
            reset_cache_data($this, "st");
            $this->session->set_flashdata('success', trans("msg_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }


    /**
     * States
     */
    public function states()
    {
        $data['title'] = trans("states");
        $data['countries'] = $this->location_model->get_countries();
        //get paginated states
        $pagination = $this->paginate(admin_url() . 'states', $this->location_model->get_paginated_states_count());
        $data['states'] = $this->location_model->get_paginated_states($pagination['per_page'], $pagination['offset']);
        
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/location/states', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add State
     */
    public function add_state()
    {
        $data['title'] = trans("add_state");
        $data['countries'] = $this->location_model->get_countries();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/location/add_state', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add State Post
     */
    public function add_state_post()
    {
        //validate inputs
        $this->form_validation->set_rules('name', trans("name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {
            if ($this->location_model->add_state()) {
                reset_cache_data($this, "st");
                $this->session->set_flashdata('success', trans("msg_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update State
     */
    public function update_state($id)
    {
        $data['title'] = trans("update_state");

        //get state
        $data['state'] = $this->location_model->get_state($id);
        if (empty($data['state'])) {
            redirect($this->agent->referrer());
        }
        $data['countries'] = $this->location_model->get_countries();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/location/update_state', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update State Post
     */
    public function update_state_post()
    {
        //validate inputs
        $this->form_validation->set_rules('name', trans("name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {
            //country id
            $id = $this->input->post('id', true);
            if ($this->location_model->update_state($id)) {
                reset_cache_data($this, "st");
                $this->session->set_flashdata('success', trans("msg_updated"));
                $redirect_url = $this->input->post('redirect_url', true);
                if (!empty($redirect_url)) {
                    redirect($redirect_url);
                } else {
                    redirect(admin_url() . 'states');
                }
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Delete State Post
     */
    public function delete_state_post()
    {
        $id = $this->input->post('id', true);
        if ($this->location_model->delete_state($id)) {
            reset_cache_data($this, "st");
            $this->session->set_flashdata('success', trans("msg_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

    /**
     * Cities
     */
    public function cities()
    {
        $data['title'] = trans("cities");
        $data['countries'] = $this->location_model->get_countries();
        $data['states'] = $this->location_model->get_states();
        //get paginated cities
        $pagination = $this->paginate(admin_url() . 'cities', $this->location_model->get_paginated_cities_count());
        $data['cities'] = $this->location_model->get_paginated_cities($pagination['per_page'], $pagination['offset']);
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/location/cities', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add Cities
     */
    public function add_city()
    {
        $data['title'] = trans("add_city");
        $data['countries'] = $this->location_model->get_countries();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/location/add_city', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add City Post
     */
    public function add_city_post()
    {
        //validate inputs
        $this->form_validation->set_rules('name', trans("name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {
            if ($this->location_model->add_city()) {
                reset_cache_data($this, "st");
                $this->session->set_flashdata('success', trans("msg_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update City
     */
    public function update_city($id)
    {
        $data['title'] = trans("update_city");

        //get city
        $data['city'] = $this->location_model->get_city($id);
        if (empty($data['city'])) {
            redirect($this->agent->referrer());
        }
        $data['countries'] = $this->location_model->get_countries();
        $data['states'] = $this->location_model->get_states_by_country($data['city']->country_id);
        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/location/update_city', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update City Post
     */
    public function update_city_post()
    {
        //validate inputs
        $this->form_validation->set_rules('name', trans("name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {
            //country id
            $id = $this->input->post('id', true);
            if ($this->location_model->update_city($id)) {
                reset_cache_data($this, "st");
                $this->session->set_flashdata('success', trans("msg_updated"));
                $redirect_url = $this->input->post('redirect_url', true);
                if (!empty($redirect_url)) {
                    redirect($redirect_url);
                } else {
                    redirect(admin_url() . 'cities');
                }
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Delete City Post
     */
    public function delete_city_post()
    {
        $id = $this->input->post('id', true);
        if ($this->location_model->delete_city($id)) {
            reset_cache_data($this, "st");
            $this->session->set_flashdata('success', trans("msg_deleted"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }

    //activate inactivate countries
    public function activate_inactivate_countries()
    {
        $action = $this->input->post('action', true);
        $this->location_model->activate_inactivate_countries($action);
        reset_cache_data($this, "st");
    }

    /**
     * Control Panel Language Post
     */
    public function control_panel_language_post()
    {
        $lang_id = $this->input->post('lang_id', true);
        $lang = $this->language_model->get_language($lang_id);
        if (!empty($lang)) {
            $this->session->set_userdata('mds_control_panel_lang', $lang);
        }
        redirect($this->agent->referrer());
    }
}
