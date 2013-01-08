<?php
/**
 * @table envs
 *
 * @field owner -has one _User -inverse envs
 * @field links -owns many _Link -inverse env -order-by stats_count DESC
 * @field title VARCHAR(32) NOT NULL
 *
 * @index owner,title(16) -unique
 */
class U_Mdl_Env extends O_Dao_ActiveRecord {
	public function __construct(U_Mdl_User $user, $title) {
		$this->owner = $user;
		$this->title = $title;
		parent::__construct();
	}
}