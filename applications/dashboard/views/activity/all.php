<?php if (!defined('APPLICATION')) exit(); ?>
<div class="Tabs ActivityTabs">
   <ul>
      <li class="Active"><?php echo Anchor(T('Recent Activity'), 'activity', 'TabLink'); ?></li>
   </ul>
</div>
<?php
$this->FireEvent('BeforeStatusForm');
$Session = Gdn::Session();
if ($Session->CheckPermission('Garden.Profiles.Edit')) {
   echo $this->Form->Open(array('action' => Url('/activity'), 'class' => 'Activity'));
   echo $this->Form->Errors();
   echo Wrap($this->Form->TextBox('Comment', array('MultiLine' => TRUE)), 'div', array('class' => 'TextBoxWrapper'));
   echo $this->Form->Button(T('Share'));
   echo $this->Form->Close();
}
if ($this->ActivityData->NumRows() > 0) {
   echo '<ul class="DataList Activities">';
   include($this->FetchViewLocation('activities', 'activity', 'dashboard'));
   echo '</ul>';
   echo PagerModule::Write(array('CurrentRecords' => $this->ActivityData->NumRows()));
} else {
   ?>
<div class="Empty"><?php echo T('Not much happening here, yet.'); ?></div>
   <?php
}
