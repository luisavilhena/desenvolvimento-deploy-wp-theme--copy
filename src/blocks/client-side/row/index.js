import CONFIG from '../../../config.json'
import classnames from 'classnames'
import insertCSS from 'insert-css'
import editorStyles from './editor.css'

insertCSS(editorStyles)

const { registerBlockType } = wp.blocks
const {
  BlockAlignmentToolbar,
  BlockControls,
  InnerBlocks,
} = wp.editor

const {
  Fragment
} = wp.element

registerBlockType(`${CONFIG.themeId}/row`, {
  title: 'Linha',
  // icon: 'universal-access-alt',
  category: CONFIG.themeId,
  attributes: {
    horizontalAlignment: {
      type: 'string',
      default: 'left',
    }
  },
  edit(props) {
    const {
      className,
      attributes: {
        horizontalAlignment
      },
      setAttributes
    } = props

    return <Fragment>
      <BlockControls>
        <BlockAlignmentToolbar
          value={horizontalAlignment}
          onChange={horizontalAlignment => setAttributes({ horizontalAlignment })}
        />
      </BlockControls>
      <div
        className={`${className}`}>
        <InnerBlocks
          allowedBlocks={[
            'dd/column',
          ]}
          template={[
            ['dd/column', {
              width: 6,
              offset: 0,
            }],
            ['dd/column', {
              width: 6,
              offset: 0,
            }],
          ]}
        />
      </div>
    </Fragment>
  },
  save(props) {
    const {
      attributes: {
        horizontalAlignment,
      },
      className
    } = props

    return <div
      className={classnames({
        row: true,
        'justify-content-start': horizontalAlignment === 'left',
        'justify-content-end': horizontalAlignment === 'right',
        'justify-content-center': horizontalAlignment === 'center',
      })}>
      <InnerBlocks.Content />
    </div>
  },
})
