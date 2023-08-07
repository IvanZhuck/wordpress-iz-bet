/**
 * WP Core Dependencies
 */
import { useState } from '@wordpress/element';
import {
	registerFormatType,
	removeFormat,
	applyFormat,
	useAnchorRef,
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

const izTooltipFormatName = 'iz-format/tooltip';

const IzTooltipEdit = ({
	isActive,
	activeAttributes,
	value,
	onChange,
	contentRef,
}) => {
	const [tooltipText, setTooltipText] = useState('');
	const [showPopover, setShowPopover] = useState(false);
	const [typingInProgress, setTypingInProgress] = useState(false);
	const anchorRef = useAnchorRef({ ref: contentRef, value });

	const toolbarButtonOnClick = () => {
		if (!isActive) {
            setTooltipText('');
			setShowPopover(true);
		} else {
			setShowPopover(false);
			onChange(removeFormat(value, izTooltipFormatName));
		}
	};

	const saveTooltipText = () => {
		if (tooltipText.length) {
			onChange(
				applyFormat(value, {
					type: izTooltipFormatName,
					attributes: {
						tooltipText,
					},
				})
			);
		} else {
			onChange(removeFormat(value, izTooltipFormatName));
		}

		setShowPopover(false);
	};

	const removeTooltip = () => {
		onChange(removeFormat(value, izTooltipFormatName));
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
					title={__('Tooltip', 'iz-bet')}
					isActive={isActive}
					onClick={toolbarButtonOnClick}
				/>
				{showPopover && (
					<Popover
						anchorRef={anchorRef}
						className="iz-tooltip-popover"
						onClose={() => setShowPopover(false)}
					>
						<TextareaControl
							label={__('Tooltip', 'iz-bet')}
							help={__('Enter tooltip text and press "Save" button', 'iz-bet')}
							className="iz-tooltip-popover__text"
							value={tooltipText}
							onChange={(newText) => {
								setTypingInProgress(true);
								setTooltipText(newText);
							}}
						/>
						<div className="iz-tooltip-popover__controls">
							<Button
								onClick={removeTooltip}
								className="iz-tooltip-popover__controls-remove components-button is-secondary is-destructive"
							>
								{__('Remove', 'iz-bet')}
							</Button>
							<Button
								onClick={saveTooltipText}
								className="iz-tooltip-popover__controls-save components-button is-primary"
							>
								{__('Save', 'iz-bet')}
							</Button>
						</div>
					</Popover>
				)}
			</ToolbarGroup>
		</BlockControls>
	);
};

registerFormatType(izTooltipFormatName, {
	title: __('Tooltip', 'iz-bet'),
	tagName: 'span',
	className: 'iz-tooltip',
	attributes: {
		tooltipText: 'aria-label',
	},
	edit: IzTooltipEdit,
});
