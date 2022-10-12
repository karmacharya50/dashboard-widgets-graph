<?php global $table_prefix, $wpdb;

    $rank_graph_dataTable = $table_prefix . 'rank_graph_data';    
    if( $wpdb->get_var( "show tables like '$rank_graph_dataTable'" ) != $rank_graph_dataTable ) {
                
        $sql = "CREATE TABLE `$rank_graph_dataTable` (";
        $sql .= " `id` int(11) NOT NULL auto_increment, ";
        $sql .= " `name` varchar(500) NOT NULL, ";
        $sql .= " `data_uv` varchar(500) NOT NULL, ";
        $sql .= " `data_pv` varchar(500), ";
        $sql .= " `value` varchar(500) NOT NULL, ";    
        $sql .= " PRIMARY KEY `rank_graph_data_id` (`id`) ";
        $sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
        
        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
        
        $initial_data = "INSERT INTO " .$rank_graph_dataTable . " (`name`, `data_uv`,`data_pv`, `value`) VALUES 
                                ('1', '4000', '3000', '2500' ),
                                ('2', '3000', '3500', '2600' ),
                                ('3', '2000', '3200', '2700' ),
                                ('4', '2500', '3600', '2800' ),
                                ('5', '3500', '2500', '2900' ),
                                ('6', '4500', '2800', '3000' ),
                                ('7', '4100', '2200', '3100' ),
                                ('8', '4200', '3100', '3200' ),
                                ('9', '3400', '3600', '33500' ),
                                ('10', '2000', '3100', '3400' ),
                                ('11', '3400', '2200', '3500' ),
                                ('12', '3300', '2800', '3600' ),
                                ('13', '3100', '2900', '3700' ),
                                ('14', '2800', '2600', '3500' ),
                                ('15', '2700', '2000', '3400' ),
                                ('16', '2500', '2700', '3500' ),
                                ('17', '2100', '3200', '3600' ),
                                ('18', '2200', '3600', '3600' ),
                                ('19', '3500', '4000', '3700' ),
                                ('20', '4000', '3900', '3500' ),
                                ('21', '4200', '3400', '3400' ),
                                ('22', '4300', '3200', '3300' ),
                                ('23', '3500', '3100', '3200' ),
                                ('24', '3700', '2900', '3400' ),
                                ('25', '3300', '3300', '3200' ),
                                ('26', '2900', '2900', '3100' ),
                                ('27', '2200', '3000', '3000' ),
                                ('28', '3700', '2800', '2900' ),
                                ('29', '4400', '3300', '3300' ),
                                ('30', '4500', '3500', '3200' );";
            $wpdb->query($initial_data);
    }?>