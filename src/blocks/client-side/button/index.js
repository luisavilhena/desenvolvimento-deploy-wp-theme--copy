import CONFIG from '../../../config.json'
import classnames from 'classnames'
import {
  getColorBy,
  getDefaultColor,
  WP_COLOR_PALETTE_COLORS
} from '../util'

const { __ } = wp.i18n
const { registerBlockType } = wp.blocks

const {
  BlockAlignmentToolbar,
  BlockControls,
  InspectorControls,
  URLInput,
  RichText
} = wp.editor

const {
  PanelBody,
  ColorPalette,
  ToggleControl,
  BaseControl
} = wp.components

const {
  Fragment
} = wp.element

const EDIT_BUTTON_STYLE = {
  padding: '10px 15px',
  display: 'inline-flex',
}

const getEditButtonStyle = attributes => {
  const backgroundColor = getColorBy('id', attributes.backgroundColorId)
  const foregroundColor = backgroundColor && backgroundColor.contrastingColorId && getColorBy('id', backgroundColor.contrastingColorId)

  return {
    ...EDIT_BUTTON_STYLE,
    backgroundColor: backgroundColor ? backgroundColor.code : 'transparent',
    color: foregroundColor ? foregroundColor.code : 'inherit',
  }
}

registerBlockType(`${CONFIG.themeId}/button`, {
  title: __('Botão'),
  category: CONFIG.themeId,
  // styles,
  attributes: {
    href: {
      type: 'string',
      default: ''
    },
    target: {
      type: 'string',
      default: '_self',
    },
    text: {
      type: 'string',
      default: null,
    },
    backgroundColorId: {
      type: 'string',
      default: getDefaultColor().id,
    },
    horizontalAlignment: {
      type: 'string',
      default: 'left',
    }
  },
  edit({ attributes, setAttributes, className }) {

    const {
      href,
      target,
      text,
      backgroundColorId,
      horizontalAlignment,
    } = attributes

    const backgroundColor = getColorBy('id', backgroundColorId)

    return <Fragment>
      <InspectorControls>
        <PanelBody>
          <BaseControl
            label={__('Link')}>
            <URLInput
              value={href}
              onChange={href => setAttributes({ href })}
            />
          </BaseControl>
          <ToggleControl
            label={__('Abrir em nova aba')}
            checked={target === '_blank'}
            onChange={() => setAttributes({
              target: target === '_blank' ? '_self' : '_blank'
            })}
          />
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
      <BlockControls>
        <BlockAlignmentToolbar
          value={horizontalAlignment}
          onChange={horizontalAlignment => setAttributes({ horizontalAlignment })}
        />
      </BlockControls>
      <div
        className={`${ className }`}>
        <div style={getEditButtonStyle(attributes)}>
          <RichText
            placeholder={__('Texto do botão')}
            value={text}
            onChange={text => setAttributes({ text })}
            keepPlaceholderOnFocus
          />
        </div>
      </div>
    </Fragment>
  },
  save({ attributes, className }) {
    const {
      href,
      target,
      text,
      backgroundColorId,
      horizontalAlignment,
    } = attributes
    const bgClassName = `bg-${attributes.backgroundColorId}`

    return <div
      className={classnames({
        [className]: Boolean(className),
        'd-flex': Boolean(horizontalAlignment),
        'justify-content-start': horizontalAlignment === 'left',
        'justify-content-end': horizontalAlignment === 'right',
        'justify-content-center': horizontalAlignment === 'center',
      })}>
      <a
        className={`btn bg-${backgroundColorId}`}
        target={target}
        href={href}
        rel='noreferrer noopener'>
        {text}
      </a>
    </div>
  }
})
