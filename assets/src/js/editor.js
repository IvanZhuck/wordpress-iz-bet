/**
 * WP Core Dependencies
 */
import { useState } from '@wordpress/element';
import {
	registerFormatType,
	removeFormat,
	applyFormat,
	useAnchor,
} from '@wordpress/rich-text';
import { BlockControls } from '@wordpress/block-editor';
import {
	Button,
	ToolbarGroup,
	ToolbarButton,
	TextareaControl,
	Popover,
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';

/**
 * Project Dependencies
 */
import { commentContent } from '@wordpress/icons';

const izbetTooltipFormatName = 'izbet-format/tooltip';

const IzbetTooltipEdit = ({
	isActive,
	activeAttributes,
	value,
	onChange,
	contentRef,
}) => {
	const [tooltipText, setTooltipText] = useState('');
	const [showPopover, setShowPopover] = useState(false);
	const [typingInProgress, setTypingInProgress] = useState(false);
	const anchorRef = useAnchor({ editableContentElement: contentRef.current });

	const toolbarButtonOnClick = () => {
		if (!isActive) {
			setTooltipText('');
			setShowPopover(true);
		} else {
			setShowPopover(false);
			onChange(removeFormat(value, izbetTooltipFormatName));
		}
	};

	const saveTooltipText = () => {
		if (tooltipText.length) {
			onChange(
				applyFormat(value, {
					type: izbetTooltipFormatName,
					attributes: {
						tooltipText: tooltipText.trim(),
					},
				})
			);
		} else {
			onChange(removeFormat(value, izbetTooltipFormatName));
		}

		setShowPopover(false);
	};

	const removeTooltip = () => {
		onChange(removeFormat(value, izbetTooltipFormatName));
		setShowPopover(false);
	};

	if (isActive && !showPopover && !typingInProgress) {
		setTypingInProgress(false);
		setShowPopover(true);
	}

	if (!isActive && !typingInProgress && showPopover && tooltipText) {
		setShowPopover(false);
	}

	if (tooltipText !== activeAttributes.tooltipText && !typingInProgress) {
		setTooltipText(activeAttributes.tooltipText);
	}

	return (
		<BlockControls>
			<ToolbarGroup>
				<ToolbarButton
					icon={commentContent}
					title={__('Tooltip', 'iz-block-editor-tooltips')}
					isActive={isActive}
					onClick={toolbarButtonOnClick}
				/>
				{showPopover && (
					<Popover
						anchor={anchorRef}
						className="izbet-tooltip-popover"
						onClose={() => setShowPopover(false)}
					>
						<TextareaControl
							label={__('Tooltip', 'iz-block-editor-tooltips')}
							help={__(
								'Enter tooltip text and press "Save" button',
								'iz-block-editor-tooltips'
							)}
							className="izbet-tooltip-popover__text"
							value={tooltipText}
							onChange={(newText) => {
								setTypingInProgress(true);
								setTooltipText(newText);
							}}
						/>
						<div className="izbet-tooltip-popover__controls">
							<Button
								onClick={removeTooltip}
								className="izbet-tooltip-popover__controls-remove components-button is-secondary is-destructive"
							>
								{__('Remove', 'iz-block-editor-tooltips')}
							</Button>
							<Button
								onClick={saveTooltipText}
								className="izbet-tooltip-popover__controls-save components-button is-primary"
							>
								{__('Save', 'iz-block-editor-tooltips')}
							</Button>
						</div>
					</Popover>
				)}
			</ToolbarGroup>
		</BlockControls>
	);
};

registerFormatType(izbetTooltipFormatName, {
	title: __('Tooltip', 'iz-block-editor-tooltips'),
	tagName: 'span',
	className: 'izbet-tooltip',
	attributes: {
		tooltipText: 'aria-label',
	},
	edit: IzbetTooltipEdit,
});
