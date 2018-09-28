<?php
if(!empty($this->session->flashdata('msg'))){
echo '<div class="alert '.$this->session->flashdata('msg_class').'">';
echo strtoupper($this->session->flashdata('msg'));
echo '</div>';
}