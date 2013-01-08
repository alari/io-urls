<?php
class U_Cmd_Api_GetShort extends O_Command {

	public function process()
	{
		$logic = new U_Logic_Api($this, 1);
		return json_encode($logic->getShortLinkArray());
	}
}
