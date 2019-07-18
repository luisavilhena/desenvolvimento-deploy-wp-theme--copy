import CONFIG from '../../../config.json'
import classnames from 'classnames'
import insertCSS from 'insert-css'
import styles from './editor.css'

insertCSS(styles)

const { registerBlockType } = wp.blocks
const {
  BlockControls,
  BlockAlignmentToolbar,
  InspectorControls,
  InnerBlocks,
} = wp.editor

const {
  PanelBody,
  RangeControl,
  SelectControl
} = wp.components

const {
  Fragment
} = wp.element

const {
  __
} = wp.i18n

const generateColumnStyles = ({ verticalAlignment, horizontalAligment }) => {
  const hasAnyAlignmentApplied = verticalAlignment || horizontalAligment

  return hasAnyAlignmentApplied ? {
    display: 'flex',
    flexDirection: 'column',
    justifyContent: ({
      top: 'flex-start',
      center: 'center',
      bottom: 'flex-end',
    })[verticalAlignment],
    alignItems: ({
      left: 'flex-start',
      center: 'center',
      right: 'flex-end'
    })[horizontalAligment],

    paddingTop: '20px',
    paddingBottom: '20px',
  } : {}
}

registerBlockType(`${CONFIG.themeId}/column`, {
  title: 'Coluna',
  // icon: 'universal-access-alt',
  category: CONFIG.themeId,
  attributes: {
    width: {
      type: 'number',
      default: 6,
    },
    offset: {
      type: 'number',
      default: 0,
    },
    verticalAlignment: {
      type: 'string',
    },
    horizontalAligment: {
      type: 'string',
    }
  },
  edit({ attributes, setAttributes, className }) {
    const onChangeAttribute = (attribute, value) => {
      setAttributes({
        [attribute]: value
      })
    }

    return <Fragment>
      <InspectorControls>
        <PanelBody>
          <RangeControl
            label={__('width')}
            value={attributes.width}
            onChange={onChangeAttribute.bind(null, 'width')}
            min={1}
            max={12}
          />
          <RangeControl
            label={__('Offset')}
            value={attributes.offset}
            onChange={onChangeAttribute.bind(null, 'offset')}
            min={0}
            max={11}
          />
          <SelectControl
            label={__('Vertical aligment')}
            onChange={verticalAlignment => {
              // We expect to use BlockVerticalAlignmentToolbar
              // in the future, thus let none be the undefined
              setAttributes({
                verticalAlignment: verticalAlignment === 'none' ?
                  undefined : verticalAlignment
              })
            }}
            value={attributes.verticalAlignment}
            options={[
              { label: __('None'), value: 'none' },
              { label: __('Top'), value: 'top' },
              { label: __('Center'), value: 'center' },
              { label: __('Bottom'), value: 'bottom' }
            ]}
          />
        </PanelBody>
      </InspectorControls>
      <BlockControls>
        <BlockAlignmentToolbar
          onChange={onChangeAttribute.bind(null, 'horizontalAligment')}
          value={attributes.horizontalAligment}
        />
      </BlockControls>
      <div
        style={generateColumnStyles(attributes)}
        className={classnames({
          [className]: Boolean(className)
        })}>
        <InnerBlocks />
      </div>
    </Fragment>
  },
  save(props) {
    const {
      className,
      attributes: {
        width,
        offset,
        verticalAlignment,
        horizontalAligment,
      }
    } = props

    const hasAnyAlignmentApplied = (verticalAlignment || horizontalAligment)

    return <div
      className={classnames({
        [className]: Boolean(className),
        [`col-md-${width}`]: true,
        [`offset-md-${offset}`]: true,
        'd-flex': hasAnyAlignmentApplied,
        'flex-column': hasAnyAlignmentApplied,
        'justify-content-start': verticalAlignment === 'top',
        'justify-content-center': verticalAlignment === 'center',
        'justify-content-end': verticalAlignment === 'bottom',
        'align-items-start': horizontalAligment === 'left',
        'align-items-center': horizontalAligment === 'center',
        'align-items-end': horizontalAligment === 'right',
      })}>
      <InnerBlocks.Content />
    </div>
  },
})
