<?php
class U_Cmd_Home extends O_Command {

	public function process()
	{
		// It is not a request
		if (!$this->getParam( "short_key" ) && !$this->getParam( "_full_url" )) {
			return $this->getTemplate();
		}

		$shortKey = $this->getParam( "short_key" );

		if ($this->getParam( "_full_url" )) {
			$tpl = $this->getTemplate();
			$tpl->envId = $this->getParam("env_id");
			$logic = new U_Logic_Api( $this, 0 );
			$result = $logic->getShortLinkArray();

			if ($result[ "status" ] == U_Logic_Api::STATUS_OK) {
				$tpl->shortUrl = $result[ "short_url" ];
			} else {
				$tpl->shortKey = $shortKey;
				$tpl->errorMsg = $result[ 'error_msg' ];
				$tpl->fullUrl = $this->getParam( "_full_url" );
			}

			return $tpl;
		}

		return $this->getTemplate();
	}
}
