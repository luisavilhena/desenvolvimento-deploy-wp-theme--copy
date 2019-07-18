import CONFIG from '../../../config.json'

const { registerBlockType } = wp.blocks
const {
  InnerBlocks,
} = wp.editor

const {
  Fragment
} = wp.element

export const registerBlockContainer = (id, name, innerBlocksOptions) => {
  registerBlockType(`${CONFIG.themeId}/${id}`, {
    title: name,
    category: CONFIG.themeId,
    edit(props) {
      return <Fragment>
        <div>
          <InnerBlocks
            {...innerBlocksOptions}
          />
        </div>
      </Fragment>
    },
    save({ className }) {
      return <div
        className={classnames({
          className: Boolean(className),
        })}>
        <InnerBlocks.Content />
      </div>
    },
  })
}
