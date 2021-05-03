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
    public function add_materials_post($materials, $price)
    {
        $data = array(
            'materials' => $materials,
            'price' => $price,
        );
        $this->db->insert('ad_predefine_materials', $data);
    }
    //get predefine materials
	public function get_materials()
	{
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

    //update materials item
    public function update_materials_item($id)
    {
        $data = array(
            'materials' => $this->input->post('add_materials', true),
            'price' => $this->input->post('add_price', true),
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
		$query = $this->db->get('ad_predefine_orientations');
		return $query->result();
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

    //delete printsizes item
    public function delete_printsizes_item($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        return $this->db->delete('ad_predefine_printsizes');
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

    //delete canvasdepths item
    public function delete_canvasdepths_item($id)
    {
        $id = clean_number($id);
        $this->db->where('id', $id);
        return $this->db->delete('ad_predefine_canvasdepths');
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

