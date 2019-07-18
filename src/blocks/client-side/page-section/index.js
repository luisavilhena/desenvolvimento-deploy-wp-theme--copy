import CONFIG from '../../../config.json'
import classnames from 'classnames'
import {
  getColorBy,
  WP_COLOR_PALETTE_COLORS
} from '../util'

const { registerBlockType } = wp.blocks
const {
  InspectorControls,
  BlockAlignmentToolbar,
  BlockControls,
  InnerBlocks,
} = wp.editor

const {
  ColorPalette,
  PanelBody,
} = wp.components

const {
  Fragment
} = wp.element

const {
  __
} = wp.i18n

const getEditPageSectionStyles = ({ backgroundColorId }) => {
  const backgroundColor = getColorBy('id', backgroundColorId)
  const foregroundColor = backgroundColor && backgroundColor.contrastingColorId && getColorBy('id', backgroundColor.contrastingColorId)

  return {
    backgroundColor: backgroundColor ? backgroundColor.code : 'transparent',
    color: foregroundColor ? foregroundColor.code : 'inherit',
  }
}

registerBlockType(`${CONFIG.themeId}/page-section`, {
  title: __('Page section'),
  // icon: 'universal-access-alt',
  category: CONFIG.themeId,
  attributes: {
    backgroundColorId: {
      type: 'string',
      default: null,
    },
    applyWebsiteMaxWidth: {
      type: 'boolean',
      default: true,
    },
    applyWebsiteSidePadding: {
      type: 'boolean',
      default: true,
    }
  },
  edit(props) {
    const {
      className,
      attributes,
      setAttributes
    } = props

    const {
      backgroundColorId
    } = attributes

    const backgroundColor = getColorBy('id', backgroundColorId)

    return <Fragment>
      <InspectorControls>
        <PanelBody>
          <ColorPalette
            colors={WP_COLOR_PALETTE_COLORS}
            value={backgroundColor && backgroundColor.code}
            onChange={code => {
              const nextColor = getColorBy('code', code)
              setAttributes({
                backgroundColorId: nextColor ? nextColor.id : null
              })
            }}
          />
        </PanelBody>
      </InspectorControls>

      <div style={getEditPageSectionStyles(attributes)}>
        <InnerBlocks
          template={[
            ['dd/row', {}, [
              ['dd/column', {
                width: 6,
                offset: 0,
              }],
              ['dd/column', {
                width: 6,
                offset: 0,
              }],
            ]]
          ]}
        />
      </div>
    </Fragment>
  },
  save(props) {
    const {
      attributes: {
        backgroundColorId,
        applyWebsiteMaxWidth,
        applyWebsiteSidePadding,
      },
      className
    } = props

    const bgClassName = backgroundColorId ? `bg-${backgroundColorId}` : false

    return <section
      className={classnames({
        [className]: Boolean(className),
        'page-section': true,
        'page-section--transparent': !Boolean(backgroundColorId),
        'page-section--with-bg': Boolean(backgroundColorId),
        [bgClassName]: Boolean(bgClassName),
      })}>
      <div
        className={classnames({
          'website-max-width': applyWebsiteMaxWidth,
          'website-side-padding': applyWebsiteSidePadding,
        })}>
        <InnerBlocks.Content />
      </div>
    </section>
  },
})
