<?php
    if ($this->request->params['admin'] &&
        $this->request->params['plugin'] == 'block' &&
        $this->request->params['controller'] == 'manage' &&
        $this->request->params['action'] == 'admin_edit' &&
        !Configure::read('Modules.TagCloud.status') &&
        isset($this->data['Block']) &&
        $this->data['Block']['module'] == 'TagCloud' &&
        $this->data['Block']['delta'] == 'widget'
    ) {
        $this->Layout->flashMsg(
            __d('tag_cloud', 'Tag Cloud module is <a href="%s">disabled</a>. This block wont be displayed!', Router::url('/admin/system/modules')),
            'alert'
        );
    }
?>
<?php $vocabularies = ClassRegistry::init('Taxonomy.Vocabulary')->find('list'); ?>
<?php echo $this->Html->useTag('fieldsetstart', __d('tag_cloud', 'Tag Cloud Configuration')); ?>
    <?php
        echo $this->Form->input('Block.settings.order',
            array(
                'type' => 'radio',
                'label' => __d('tag_cloud', 'Sort order'),
                'separator' => '<br />',
                'options' => array(
                    'weight-asc' => __d('tag_cloud', 'by weight, ascending'),
                    'weight-desc' => __d('tag_cloud', 'by weight, descending'),
                    'title-asc' => __d('tag_cloud', 'by title, ascending'),
                    'title-desc' => __d('tag_cloud', 'by title, descending'),
                    'random' => __d('tag_cloud', 'random')
                )
            )
        );
    ?>

    <?php
        echo $this->Form->input('Block.settings.amount',
            array(
                'type' => 'text',
                'label' => __d('tag_cloud', 'Amount of tags on the block')
            )
        );
    ?>
    <em><?php echo __d('tag_cloud', 'The amount of tags that will show up in the cloud.'); ?></em>

    <?php
        echo $this->Form->input('Block.settings.steps',
            array(
                'type' => 'text',
                'label' => __d('tag_cloud', 'Number of levels')
            )
        );
    ?>
    <em><?php echo __d('tag_cloud', 'The number of levels between the least popular tags and the most popular ones. Different levels will be assigned a different class to be themed in tagcloud.css'); ?></em>

    <?php
        echo $this->Form->input('Block.settings.vocabularies',
            array(
                'type' => 'select',
                'label' => __d('tag_cloud', 'Vocabularies'),
                'options' => $vocabularies,
                'multiple' => true,
                'empty'  => __d('tag_cloud', 'All')
            )
        );
    ?>
    <em><?php echo __d('tag_cloud', 'The vocabularies which supplies the terms for this cloud.'); ?></em>

<?php echo $this->Html->useTag('fieldsetend'); ?>