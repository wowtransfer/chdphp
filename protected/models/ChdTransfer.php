<?php

/**
 * This is the model class for table "chd_transfer".
 *
 * The followings are the available columns in table 'chd_transfer':
 * @property string $id
 * @property string $account_id
 * @property string $server
 * @property string $realmlist
 * @property string $realm
 * @property string $username_old
 * @property string $username_new
 * @property string $char_guid
 * @property string $create_char_date
 * @property string $create_transfer_date
 * @property integer $status
 * @property string $account
 * @property string $pass
 * @property integer $file_lua_crypt
 * @property string $file_lua
 * @property string $options
 * @property string $comment
 */
class ChdTransfer extends CActiveRecord
{
	// virtual attributes
	public $transferOptions = array();
	public $fileLua;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'chd_transfer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_id, char_guid, status, file_lua_crypt', 'numerical', 'integerOnly'=>true),
			//array('account_id, char_guid', 'length', 'max'=>10),
			array('account_id', 'compare', 'allowEmpty'=>false, 'compareValue'=>0, 'operator'=>'>', 'strict'=>true),
			array('server', 'length', 'max'=>100),
			array('account', 'length', 'max'=>32),
			array('file_lua', 'length', 'allowEmpty'=>false),
			array('realmlist, realm, pass', 'length', 'max'=>40),
			array('username_old, username_new', 'length', 'max'=>12),
			array('options, comment', 'length', 'max'=>255),
			array('create_char_date', 'safe'),

			array('server, realmlist, realm, account, pass, username_old, transferOptions', 'required'),
			array('transferOptions', 'type', 'type' => 'array', 'allowEmpty' => false),

			// create
			array('file_lua, fileLua', 'required', 'on' => 'create'),
			array('fileLua', 'file', 'types' => 'lua', 'allowEmpty' => false, 'maxFiles' => 1, 'maxSize' => 1024 * 600, 'on' => 'create'),

			// update

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, account_id, server, realmlist, realm, username_old, username_new, char_guid, create_char_date, create_transfer_date, status, account, pass, file_lua_crypt, file_lua, options, comment', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID заявки',
			'account_id' => 'ID аккаунта',
			'server' => 'Название',
			'realmlist' => 'Реалмлист',
			'realm' => 'Реалм',
			'account' => 'Аккаунта',
			'pass' => 'Пароль',
			'username_old' => 'Имя персонажа',
			'username_new' => 'Имя персонажа на текущем сервере',
			'char_guid' => 'GUID персонажа',
			'create_char_date' => 'Дата создания персонажа',
			'create_transfer_date' => 'Дата создания заявки',
			'status' => 'Статус',
			'file_lua_crypt' => 'Lua-дамп зашифрован?',
			'file_lua' => 'Содержимое lua-дампа',
			'options' => 'Опции переноса',
			'comment' => 'Комментарий',
			// virtual
			'transferOptions' => 'Опции переноса',
			'fileLua' => 'Lua-дамп',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('account_id',$this->account_id,true);
		$criteria->compare('server',$this->server,true);
		$criteria->compare('realmlist',$this->realmlist,true);
		$criteria->compare('realm',$this->realm,true);
		$criteria->compare('username_old',$this->username_old,true);
		$criteria->compare('username_new',$this->username_new,true);
		$criteria->compare('char_guid',$this->char_guid,true);
		$criteria->compare('create_char_date',$this->create_char_date,true);
		$criteria->compare('create_transfer_date',$this->create_transfer_date,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('account',$this->account,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('file_lua_crypt',$this->file_lua_crypt);
		$criteria->compare('file_lua',$this->file_lua,true);
		$criteria->compare('options',$this->options,true);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function __get($name)
	{
		if ($name == 'statusName')
		{
			if ($this->status == 0)
				return 'В процессе';
			return $this->status;
		}
		return parent::__get($name);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ChdTransfer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeValidate()
	{
		if (!parent::beforeValidate())
			return false;

		if ($this->isNewRecord)
		{
			$this->account_id = Yii::app()->user->id;
			//$this->create_transfer_date = date('Y-m-d h:i:s'); // fills by MySQL
			if (is_object($this->fileLua) && $this->fileLua instanceof CUploadedFile)
				$this->file_lua = $this->luaDumpToDb(file_get_contents($this->fileLua->tempName));
			// check *.lua files by hash
			// ...
		}

		if (is_array($this->transferOptions))
			$this->options = implode(';', $this->transferOptions);

		return true;
	}

	/**
	 * Compress lua dump content
	 *
	 * @return string Compressed string
	 */
	public function luaDumpToDb($luaDumpContent)
	{
		return gzcompress($luaDumpContent);
	}

	/**
	 * Decompress lua dump content
	 *
	 * @return string Lua-dump content
	 */
	public function luaDumpFromDb()
	{
		return gzuncompress($this->file_lua);
	}

	/**
	 * @return array Key - option's name, Value - option's title
	 */
	public function getTransferOptionsToUser()
	{
		$trasnferOptions = array();
		$options = Wowtransfer::getTransferOptions();

		foreach ($options as $name => $option)
			$trasnferOptions[$name] = $option['label'];

		return $trasnferOptions;
	}

	public function getTransferOptionsFromDb()
	{
		if (empty($this->options))
			return array();

		return explode(';', $this->options);
	}
}
