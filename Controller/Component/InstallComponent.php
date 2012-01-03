<?php
class InstallComponent extends Component {
	var $Controller = null;

    public function beforeInstall($Installer) {
        return true;
    }

    public function afterInstall($Installer) {
        # create block widget
        $block = array(
            'Block' => array(
                'module' => 'TagCloud',
                'delta' => 'widget',
                'themes_cache' => '',
                'ordering' => 1,
                'status' => 1,
                'visibility' => 0,
                'pages' => '',
                'title' => 'Tags Cloud',
                'locale' => null,
                'settings' => array(
                    'order' => 'random',
                    'amount' => 60,
                    'steps' => 6
                )
            )
        );

        ClassRegistry::init('Block.Block')->save($block);

        return true;
    }

    public function beforeUninstall($Installer) {
        return true;
    }

    public function afterUninstall($Installer) {
        return true;
    }
}