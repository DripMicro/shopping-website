<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Predefine_model extends CI_Model
{


	//input values
	public function input_values()
	{
		$data = array(
			'name' => $this->input->post('name', true),
			'email' => $this->input->post('email', true),
			'message' => $this->input->post('message', true)
		);
		return $data;
	}

    //get index framestyles
    public function get_index_framestyles($id)
    {
        $this->db->where('id', clean_number($id));
        return $this->db->get('ad_predefine_framestyles')->row();
    }

	//add contact message
	public function add_contact_message()
	{
		$data = $this->input_values();
		//send email
		if ($this->general_settings->send_email_contact_messages == 1) {
			$email_data = array(
				'email_type' => 'contact',
				'message_name' => $data['name'],
				'message_email' => $data['email'],
				'message_text' => $data['message']
			);
			$this->session->set_userdata('mds_send_email_data', json_encode($email_data));
		}

		$data["created_at"] = date('Y-m-d H:i:s');
		return $this->db->insert('contacts', $data);
	}


    //-----------------
    
    //add type name
    public function add_type_post($type)
    {
        $data = array(
            'type' => $type,
            'date' => "2021-12-13"
        );
        $this->db->insert('ad_predefine_type', $data);
    }

	//get predefine type
	public function get_type()
	{
		$query = $this->db->get('ad_predefine_type');
		return $query->result();
	}

    //get type item
    public function get_type_item($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        $query = $this->db->get('ad_predefine_type');
        return $query->row();
    }

    //update type item
    public function update_type_item($id)
    {
        $data = array(
            'type' => $this->input->post('add_type', true),
        );

        $this->db->where('id', $id);
        return $this->db->update('ad_predefine_type', $data);
    }

    //delete type item
    public function delete_type_item($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        return $this->db->delete('ad_predefine_type');
    }



    //  ---------------------------------------------------

    //add categories name
    public function add_categories_post($categories)
    {
        $data = array(
            'category' => $categories,
        );
        $this->db->insert('ad_predefine_categories', $data);
    }
    //get predefine categories
	public function get_categories()
	{
		$query = $this->db->get('ad_predefine_categories');
		return $query->result();
	}

    //get categories item
    public function get_categories_item($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        $query = $this->db->get('ad_predefine_categories');
        return $query->row();
    }

    //update categories item
    public function update_categories_item($id)
    {
        $data = array(
            'category' => $this->input->post('add_categories', true),
        );

        $this->db->where('id', $id);
        return $this->db->update('ad_predefine_categories', $data);
    }

    //delete categories item
    public function delete_categories_item($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        return $this->db->delete('ad_predefine_categories');
    }

    // -------------------------------------------

    //  ---------------------------------------------------

    //add materials name
    public function add_materials_post($materials)
    {
        $data = array(
            'materials' => $materials,
            // 'price' => $price,
        );
        $this->db->insert('ad_predefine_materials', $data);
    }
    //get predefine materials
	public function _get_materials()
	{
		$query = $this->db->get('ad_predefine_materials');
		return $query->result();
	}

    //get predefine materials
	public function get_materials()
	{
        $this->db->where('status', '1');
		$query = $this->db->get('ad_predefine_materials');
		return $query->result();
	}

    //get materials item
    public function get_materials_item($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        $query = $this->db->get('ad_predefine_materials');
        return $query->row();
    }

    public function get_id_by_material_name($material_name)
    {
        // echo "<h1>".$material_name."</h1>";
        // $this->db->where('materials', $material_name);
        // $query = $this->db->get('ad_predefine_materials');

        // return $query->row()->id;

        $select = "SELECT id FROM ad_predefine_materials WHERE materials = '$material_name'";
        $res = $this->db->query($select)->row();

        if(!empty($res)) return $res->id;
        else return "300";
    }

    //update materials item
    public function update_materials_item($id)
    {
        $data = array(
            'materials' => $this->input->post('add_materials', true),
            // 'price' => $this->input->post('add_price', true),
        );

        $this->db->where('id', $id);
        return $this->db->update('ad_predefine_materials', $data);
    }

    //update materials item status
    public function update_materials_item_status($id, $status)
    {
        $data = array(
            'status' => $status,
        );

        $this->db->where('id', $id);
        return $this->db->update('ad_predefine_materials', $data);
    }

    //delete materials item
    public function delete_materials_item($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        return $this->db->delete('ad_predefine_materials');
    }

    // -------------------------------------------

     //  ---------------------------------------------------

    //add orientations name
    public function add_orientations_post($orientations)
    {
        $data = array(
            'orientations' => $orientations,
        );
        $this->db->insert('ad_predefine_orientations', $data);
    }
    //get predefine orientations
	public function get_orientations()
	{
        $qr = '"Orientation"';
        // $this->db->like('name_array', $qr);
        // $res = $this->db->get('custom_fields');
		// $query = $this->db->get('ad_predefine_orientations');
		// return $query->result();
        $field_option = $this->db->select('*')->from('custom_fields')->where("name_array LIKE '%$qr%'")->get()->row()->id;
        // $res = $this->db
        //     ->select('*')
        //     ->from('custom_fields_options')
        //     ->where("field_id =", "$field_option")
        //     ->get()
        //     ->result();
        $res = $this->db->query("SELECT t1.*, t2.option_name, t2.lang_id FROM (SELECT * FROM custom_fields_options WHERE field_id = $field_option) t1 LEFT JOIN custom_fields_options_lang t2  ON t1.id = t2.option_id");

        return $res->result();
	}

    //get orientations item
    public function get_orientations_item($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        $query = $this->db->get('ad_predefine_orientations');
        return $query->row();
    }

    //update orientations item
    public function update_orientations_item($id)
    {
        $data = array(
            'orientations' => $this->input->post('add_orientations', true),
        );

        $this->db->where('id', $id);
        return $this->db->update('ad_predefine_orientations', $data);
    }

    //delete orientations item
    public function delete_orientations_item($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        return $this->db->delete('ad_predefine_orientations');
    }

    // -------------------------------------------


     //  ---------------------------------------------------

    //add printsizes name
    public function add_printsizes_post($material_id, $orientation_id, $printsizes, $price)
    {
        $data = array(
            'materials' => $material_id,
            'orientations' => $orientation_id,
            'size' => $printsizes,
            'price' => $price,
        );
        $this->db->insert('ad_predefine_printsizes', $data);
    }
    //get predefine printsizes
	public function get_printsizes()
	{
		$query = $this->db->get('ad_predefine_printsizes');
		return $query->result();
	}

    //get printsizes item
    public function get_printsizes_item($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        $query = $this->db->get('ad_predefine_printsizes');
        return $query->row();
    }

    //update printsizes item
    public function update_printsizes_item($id)
    {
        $data = array(
            'materials' => $this->input->post('material', true),
            'orientations' => $this->input->post('orientation', true),
            'size' => $this->input->post('add_printsize', true),
            'price' => $this->input->post('add_price', true),
        );

        $this->db->where('id', $id);
        return $this->db->update('ad_predefine_printsizes', $data);
    }

    //update printsizes item status
    public function update_printsizes_item_status($id, $status)
    {
        $data = array(
            'status' => $status,
        );

        $this->db->where('id', $id);
        return $this->db->update('ad_predefine_printsizes', $data);
    }

    //delete printsizes item
    public function delete_printsizes_item($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        return $this->db->delete('ad_predefine_printsizes');
    }

    //get printsizes item
    public function get_printsizes_by_material($material_id, $orient_id)
    {
        $material_id = clean_number($material_id);
        $orient_id = clean_number($orient_id);
        $this->db->where('materials', $material_id);
        $this->db->where('orientations', $orient_id);
        $query = $this->db->get('ad_predefine_printsizes');
        return $query->result();
    }

    // -------------------------------------------


    //  ---------------------------------------------------

    //add finishoptions name
    public function add_finishoptions_post($finishoptions, $price)
    {
        $data = array(
            'finishoptions' => $finishoptions,
            'price' => $price,
        );
        $this->db->insert('ad_predefine_finishoptions', $data);
    }
    //get predefine finishoptions
	public function get_finishoptions()
	{
		$query = $this->db->get('ad_predefine_finishoptions');
		return $query->result();
	}

    //get finishoptions item
    public function get_finishoptions_item($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        $query = $this->db->get('ad_predefine_finishoptions');
        return $query->row();
    }

    //update finishoptions item
    public function update_finishoptions_item($id)
    {
        $data = array(
            'finishoptions' => $this->input->post('add_finishoptions', true),
            'price' => $this->input->post('add_price', true),
        );

        $this->db->where('id', $id);
        return $this->db->update('ad_predefine_finishoptions', $data);
    }

    //update finishoptions item status
    public function update_finishoptions_item_status($id, $status)
    {
        $data = array(
            'status' => $status,
        );

        $this->db->where('id', $id);
        return $this->db->update('ad_predefine_finishoptions', $data);
    }

    //delete finishoptions item
    public function delete_finishoptions_item($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        return $this->db->delete('ad_predefine_finishoptions');
    }

    // -------------------------------------------


    //  ---------------------------------------------------

    //add canvasdepths name
    public function add_canvasdepths_post($canvasdepths, $price)
    {
        $data = array(
            'canvasdepths' => $canvasdepths,
            'price' => $price,
        );
        $this->db->insert('ad_predefine_canvasdepths', $data);
    }
    //get predefine canvasdepths
	public function get_canvasdepths()
	{
		$query = $this->db->get('ad_predefine_canvasdepths');
		return $query->result();
	}

    //get canvasdepths item
    public function get_canvasdepths_item($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        $query = $this->db->get('ad_predefine_canvasdepths');
        return $query->row();
    }

    //update canvasdepths item
    public function update_canvasdepths_item($id)
    {
        $data = array(
            'canvasdepths' => $this->input->post('add_canvasdepths', true),
            'price' => $this->input->post('add_price', true),
        );

        $this->db->where('id', $id);
        return $this->db->update('ad_predefine_canvasdepths', $data);
    }

    //update canvasdepths item status
    public function update_canvasdepths_item_status($id, $status)
    {
        $data = array(
            'status' => $status,
        );

        $this->db->where('id', $id);
        return $this->db->update('ad_predefine_canvasdepths', $data);
    }

    //delete canvasdepths item
    public function delete_canvasdepths_item($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        return $this->db->delete('ad_predefine_canvasdepths');
    }

    // -------------------------------------------


     //  ---------------------------------------------------$material_id, $image, $framestyles, $price

    //add framestyles name
    public function add_framestyles_post($material_id, $framestyles, $price)
    {
        $data = array(
            'materials' => $material_id,
            'framestyles' => $framestyles,
            'price' => $price,
        );

        $this->load->model('upload_model');
        $file_path = $this->upload_model->ad_upload('file');
        if (!empty($file_path)) {
            $data["image"] = $file_path;
        }

        $this->db->insert('ad_predefine_framestyles', $data);
    }
    //get predefine framestyles
	public function get_framestyles()
	{
		$query = $this->db->get('ad_predefine_framestyles');
		return $query->result();
	}
    

    //get framestyles item
    public function get_framestyles_item($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        $query = $this->db->get('ad_predefine_framestyles');
        return $query->row();
    }

    //get framestyles item by material id
    public function get_framestyles_item_by_material_id($material_id)
    {
        $material_id = clean_number($material_id);
        $this->db->where('materials', $material_id);
        $query = $this->db->get('ad_predefine_framestyles');
        return $query->result();
    }

    //update framestyles item
    public function update_framestyles_item($id)
    {
        $frame = $this->get_index_framestyles($id);
        if (!empty($frame)) {
            $data = array(
                'framestyles' => $this->input->post('add_framestyles', true),
                'materials' => $this->input->post('material', true),
                'price' => $this->input->post('add_price', true),
            );
            $this->load->model('upload_model');
            $file_path = $this->upload_model->ad_upload('file');
            if (!empty($file_path)) {
                $data["image"] = $file_path;
            }
            $this->db->where('id', $frame->id);
            return $this->db->update('ad_predefine_framestyles', $data);
        }
        return false;
    }

    //update framestyles item status
    public function update_framestyles_item_status($id, $status)
    {
        $data = array(
            'status' => $status,
        );

        $this->db->where('id', $id);
        return $this->db->update('ad_predefine_framestyles', $data);
    }

    //delete framestyles item
    public function delete_framestyles_item($id)
    {
        $frame = $this->get_index_framestyles($id);
        if (!empty($frame)) {
            delete_file_from_server($frame->image);
            $this->db->where('id', $frame->id);
            return $this->db->delete('ad_predefine_framestyles');
        }
        return false;
    }

    // -------------------------------------------

    //get minmaxprice item
    public function get_minmaxprice()
    {
        $id = clean_number('1');
        $this->db->where('id', $id);
        $query = $this->db->get('ad_predefine_minmaxsettings');
        return $query->row();
    }

    //update minmaxsettings item
    public function update_minmaxsettings_item($id)
    {
        $data = array(
            'min_value' => $this->input->post('add_min_price', true),
            'max_value' => $this->input->post('add_max_price', true),
        );

        $this->db->where('id', $id);
        return $this->db->update('ad_predefine_minmaxsettings', $data);
    }
    // -------------------------------------------

    //get first value
	public function get_first_category()
	{
		$query = $this->db->get('categories');
        $ret = $query->row();
		return $ret->id;
	}

    public function get_first_product()
	{
		$query = $this->db->get('products');
		$ret = $query->row();
		return $ret->id;
	}

    public function get_first_material()
	{
        $this->db->where('status', '1');
		$query = $this->db->get('ad_predefine_materials');
		$ret = $query->row();
		return $ret->id;
	}

    // -------------------------------------------


	//get contact message
	public function get_contact_message($id)
	{
		$id = clean_number($id);
		$this->db->where('id', $id);
		$query = $this->db->get('contacts');
		return $query->result();
	}

	//get last contact messages
	public function get_last_contact_messages()
	{
		$this->db->limit(5);
		$query = $this->db->get('contacts');
		return $query->result();
	}

	//delete contact message
	public function delete_contact_message($id)
	{
		$id = clean_number($id);
		$contact = $this->get_contact_message($id);

		if (!empty($contact)) {
			$this->db->where('id', $id);
			return $this->db->delete('contacts');
		}
		return false;
	}
}

