import CONFIG from '../../../config.json'

export const arrayGetBy = (arr, key, value) => {
  return arr.find(item => item[key] === value)
}

export const WP_COLOR_PALETTE_COLORS = CONFIG.themeColors.map(color => {
  return {
    name: color.label,
    color: color.code
  }
})

export const getDefaultColor = () => {
  return CONFIG.themeColors[0]
}

export const getColorBy = arrayGetBy.bind(null, CONFIG.themeColors)

export * from './blocks'
