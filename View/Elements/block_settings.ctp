<?php echo $this->Html->useTag('fieldsetstart', __d('tag_cloud', 'Tag Cloud Configuration')); ?>
    <?php
        echo  $this->Form->input('Block.settings.order',
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
        echo  $this->Form->input('Block.settings.amount',
            array(
                'type' => 'text',
                'label' => __d('tag_cloud', 'Amount of tags on the pages')
            )
        );
    ?>
    <em><?php echo __d('tag_cloud', 'The amount of tags that will show up in the block.'); ?></em>

    <?php
        echo  $this->Form->input('Block.settings.steps',
            array(
                'type' => 'text',
                'label' => __d('tag_cloud', 'Number of levels')
            )
        );
    ?>
    <em><?php echo __d('tag_cloud', 'The number of levels between the least popular tags and the most popular ones. Different levels will be assigned a different class to be themed in tagcloud.css'); ?></em>
<?php echo $this->Html->useTag('fieldsetend'); ?>