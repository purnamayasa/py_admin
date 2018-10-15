<?php

function crud_data_link_create($url) {
	echo '<p><a href="' . $url . '">Create</a></p>';
}

function crud_data_button_create($url) {
	echo '<p><a href="' . $url . '"><button type="button">Create</button></a></p>';
}

function crud_data_option_select() {
	echo '<option value="">- Select -</option>';
}

function crud_data_option_update($url) {
	echo '<option value="' . $url . '">Update</option>';
}

function crud_data_option_delete($url) {
	echo '<option value="' . $url . '">Delete</option>';
}

function crud_form_button_save() {
	echo '<button type="submit" name="submit" value="save">Save</button>';
}