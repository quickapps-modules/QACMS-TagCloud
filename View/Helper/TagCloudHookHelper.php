<?php
class TagCloudHookHelper extends AppHelper {
    public function stylesheets_alter(&$css) {
        $css['all'][] = '/tag_cloud/css/tagcloud.css';
    }

    public function tag_cloud_widget($block) {
        $out = '';
        $settings = array_merge(
            array(
                'order' => 'random',
                'amount' => 60,
                'steps' => 6
            ), $block['Block']['settings']
        );

        switch ($settings['order']) {
            case 'random': 
                $order = 'RAND()';
            break;

            case 'weight-desc':
                default:
                    $order = array('term_count' => 'DESC');
            break;

            case 'weight-desc':
                default:
                    $order = array('term_count' => 'DESC');
            break;

            case 'title-desc':
                default:
                    $order = array('Term.name' => 'DESC');
            break;

            case 'title-asc':
                default:
                    $order = array('Term.name' => 'ASC');
            break;
        }

        $NodesTerms = ClassRegistry::init('NodesTerms');

        $NodesTerms->bindModel(
            array(
                'belongsTo' => array(
                    'Term' => array(
                        'className' => 'Taxonomy.Term'
                    )
                )
            )
        );

        $terms = $NodesTerms->find('all',
            array(
                'fields' => array(
                    'NodesTerms.term_id',
                    'NodesTerms.id', "COUNT('NodesTerms.id') as term_count",
                    'Term.id',
                    'Term.name',
                    'Term.slug',
                    'Term.description',
                    'Term.vocabulary_id',
                ),
                'group' => 'NodesTerms.term_id',
                'order' => $order,
                'limit' => (int)$settings['amount']
            )
        );

        $min = 1e9;
        $max = -1e9;

        foreach ($terms as &$term) {
            $term['NodesTerms']['nodes_count'] = $term['NodesTerms']['term_count'] = $term[0]['term_count'];
            $term['NodesTerms']['term_count'] = log($term['NodesTerms']['term_count']);
            $min = min($min, $term['NodesTerms']['term_count']);
            $max = max($max, $term['NodesTerms']['term_count']);

            unset($term[0]);
        }

        $range = max(.01, $max - $min) * 1.0001;

        foreach ($terms as &$term) {
            $term['NodesTerms']['weight'] = 1 + floor((int)$settings['steps'] * ($term['NodesTerms']['term_count'] - $min) / $range);
        }

        foreach ($terms as &$term) {
            $out .= $this->_View->Html->link(
                $term['Term']['name'],
                "/s/term:{$term['Term']['slug']}",
                array(
                    'class' => "tagcloud level-{$term['NodesTerms']['weight']}",
                    'rel' => 'tag',
                    'title' => $term['Term']['description']
                )
            );
            $out .= " \n";
        }

        return array('body' => $out);
    }

    public function tag_cloud_widget_settings($data) {
        return $this->_View->element('TagCloud.block_settings', array('block' => $data));
    }
}