<?php
namespace model\core;

class Form {

	protected static function text($label, $name, $content = null) {
		return 	'<p class="row">
					<label class="col-md-3">'. $label .'</label>
					<input type="text" name="'. $name .'" class="col-md-9" value="'.$content.'" required>
				</p>';
	}

	protected static function pass($label, $name, $content = null) {
		return 	'<p class="row">
					<label class="col-md-3">'. $label .'</label>
					<input type="password" name="'. $name .'" class="col-md-9" value="'.$content.'" required>
				</p>';
	}

	protected static function textArea($label, $name, $content = null, $tinyMce = false) {
		if ($tinyMce == true) {
			$id = ' id="tinyEditor"';
			$required = '';
		} else {
			$id = '';
			$required = ' required';
		}
		return 	'<p class="row">
					<label class="col-md-3">'. $label .'</label>
					<textarea name="'. $name .'" class="col-md-9"'.$id.$required.'>'.$content.'</textarea>
				</p>';
	}

	protected static function list($label, $name, $values, $isSelect = null) {
		$select = '<p class="row">';
		$select .= '<label class="col-md-3">'. $label .'</label>';
		$select .= 	'<select name="'.$name.'" class="col-md-2">';
		foreach ($values as $value) {
			if ($value->id == $isSelect) {
				$select .=	'<option value="'.$value->id.'" selected>'.$value->name.'</option>';
			}
			else {
				$select .=	'<option value="'.$value->id.'">'.$value->name.'</option>';
			}
		}
		$select .= '</select>';
		return $select;		
	}

	protected static function upload($label, $name) {
		return 	'<p class="row">
					<label class="col-md-3">'. $label .'</label>
					<input type="file" name="'. $name .'" class="col-md-9">
				</p>';
	}

	protected static function submit($value) {
		return 	'<p class="row">
					<input type="submit" value="'. $value .'" class="btn btn-primary">
				</p>';
	}

	protected static function hidden($name, $value) {
		return '<input type="hidden" name="'.$name.'" value="'.$value.'">';
	}

}