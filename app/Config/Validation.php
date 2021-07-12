<?php namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $register = [
		'nim' => 'required|numeric|min_length[9]|max_length[9]',
		'nama' => 'required|regex_match[^(?!\.)[A-Za-z. ]+$]',
		'email' => 'required|valid_email',
	];
	 
	public $register_errors = [
		'nim' => [
			'required'      => 'nim wajib diisi',
			'numeric' 		=> 'nim hanya boleh diisi dengan angka',
			'min_length'    => 'nim minimal terdiri dari 9 karakter',
			'max_length'    => 'nim maksimal terdiri dari 9 karakter'
		],
		'nama' => [
			'required'      => 'nim wajib diisi',
			'regex_match' 	=> 'nama hanya boleh diisi dengan huruf'
		],
		'email' => [
			'required'          => 'Email wajib diisi',
			'email.valid_email' => 'Email tidak valid'
		],
	];
}
