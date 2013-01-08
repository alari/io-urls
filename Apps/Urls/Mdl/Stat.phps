<?php
/**
 * @table link_stats
 *
 * @field link -has one _Link -inverse stats
 * @field time INT
 * @field remote_addr VARCHAR(64)
 * @field referer_host VARCHAR(32)
 * @field referer_path VARCHAR(64)
 *
 * @tail Engine=MyISAM
 */
class U_Mdl_Stat extends O_Dao_ActiveRecord {

}