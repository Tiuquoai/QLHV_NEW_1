<?php

ob_start();
session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Home AD Hệ Thống</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="shortcut icon" href="./img/jahja (1).ico" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
:root {
    --primary: #4F46E5;
    --primary-dark: #4338CA;
    --primary-light: #818CF8;
    --secondary: #10B981;
    --secondary-dark: #059669;
    --bg-gradient-start: #667eea;
    --bg-gradient-end: #764ba2;
    --card-bg: #ffffff;
    --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --card-shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    --text-primary: #1F2937;
    --text-secondary: #6B7280;
    --text-light: #9CA3AF;
    --border-color: #E5E7EB;
    --bg-body: #F9FAFB;
    --chat-primary: #4F46E5;
    --chat-bg: #F3F4F6;
    --chat-user-bg: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --chat-bot-bg: #FFFFFF;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: linear-gradient(135deg, var(--bg-body) 0%, #EEF2FF 100%);
    min-height: 100vh;
    color: var(--text-primary);
    line-height: 1.6;
}

/* ===================== HEADER ===================== */
.header-main {
    background: linear-gradient(135deg, var(--primary) 0%, var(--bg-gradient-end) 100%);
    padding: 20px 0;
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: 0 4px 20px rgba(79, 70, 229, 0.3);
}

.header-main .header-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 16px;
}

.header-logo {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    object-fit: cover;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.header-title {
    color: #fff;
    font-size: 1.5rem;
    font-weight: 700;
    letter-spacing: -0.02em;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.header-subtitle {
    color: rgba(255, 255, 255, 0.85);
    font-size: 0.875rem;
    font-weight: 400;
    margin-top: 2px;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 12px;
}

.admin-badge {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 10px 18px;
    border-radius: 50px;
    color: #fff;
    font-size: 0.875rem;
    font-weight: 500;
    border: 1px solid rgba(255, 255, 255, 0.25);
}

.admin-badge i {
    font-size: 1rem;
}

/* ===================== MAIN CONTENT ===================== */
.main-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 48px 24px;
}

.welcome-section {
    text-align: center;
    margin-bottom: 48px;
}

.welcome-section h1 {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 8px;
}

.welcome-section p {
    color: var(--text-secondary);
    font-size: 1.1rem;
}

.welcome-section .divider {
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    margin: 20px auto 0;
    border-radius: 2px;
}

/* ===================== MENU CARDS ===================== */
.menu-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
    margin-bottom: 48px;
}

.menu-card {
    background: var(--card-bg);
    border-radius: 20px;
    padding: 32px 24px;
    text-align: center;
    text-decoration: none;
    color: var(--text-primary);
    box-shadow: var(--card-shadow);
    border: 1px solid var(--border-color);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.menu-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.menu-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--card-shadow-hover);
    border-color: var(--primary-light);
}

.menu-card:hover::before {
    transform: scaleX(1);
}

.menu-card-icon {
    width: 80px;
    height: 80px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 2.2rem;
    transition: transform 0.3s ease;
}

.menu-card:hover .menu-card-icon {
    transform: scale(1.1);
}

.menu-card-icon.green {
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
    color: #fff;
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
}

.menu-card-icon.blue {
    background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
    color: #fff;
    box-shadow: 0 8px 20px rgba(59, 130, 246, 0.35);
}

.menu-card-icon.purple {
    background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
    color: #fff;
    box-shadow: 0 8px 20px rgba(139, 92, 246, 0.35);
}

.menu-card-icon.pink {
    background: linear-gradient(135deg, #EC4899 0%, #DB2777 100%);
    color: #fff;
    box-shadow: 0 8px 20px rgba(236, 72, 153, 0.35);
}

.menu-card-icon.cyan {
    background: linear-gradient(135deg, #06B6D4 0%, #0891B2 100%);
    color: #fff;
    box-shadow: 0 8px 20px rgba(6, 182, 212, 0.35);
}

.menu-card-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 6px;
}

.menu-card-desc {
    font-size: 0.85rem;
    color: var(--text-secondary);
}

/* ===================== CHAT AI BUTTON (FAB) ===================== */
.chat-fab {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary) 0%, #764ba2 100%);
    color: #fff;
    border: none;
    cursor: pointer;
    box-shadow: 0 8px 30px rgba(79, 70, 229, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    z-index: 9999;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
}

.chat-fab::before {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.chat-fab:hover {
    transform: scale(1.1);
    box-shadow: 0 12px 40px rgba(79, 70, 229, 0.6);
}

.chat-fab:hover::before {
    opacity: 1;
}

.chat-fab i {
    transition: transform 0.3s ease;
}

.chat-fab:hover i {
    transform: scale(1.1);
}

.chat-fab .badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #EF4444;
    color: #fff;
    font-size: 0.7rem;
    padding: 4px 8px;
    border-radius: 20px;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
}

.chat-fab .pulse-ring {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: rgba(79, 70, 229, 0.4);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); opacity: 1; }
    100% { transform: scale(1.5); opacity: 0; }
}

/* ===================== CHAT MODAL ===================== */
.chat-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    z-index: 10000;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.chat-overlay.active {
    opacity: 1;
    visibility: visible;
}

.chat-container {
    position: fixed;
    bottom: 0;
    right: 24px;
    width: 720px;
    max-height: 700px;
    background: #fff;
    border-radius: 20px 20px 0 0;
    box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.2);
    z-index: 10001;
    transform: translateY(100%);
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.chat-container.active {
    transform: translateY(0);
}

.chat-header {
    background: linear-gradient(135deg, var(--primary) 0%, #764ba2 100%);
    color: #fff;
    padding: 20px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
}

.chat-header-info {
    display: flex;
    align-items: center;
    gap: 14px;
}

.chat-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.chat-header-text h3 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 2px;
}

.chat-header-text p {
    font-size: 0.8rem;
    opacity: 0.85;
    display: flex;
    align-items: center;
    gap: 6px;
}

.chat-status {
    width: 8px;
    height: 8px;
    background: #10B981;
    border-radius: 50%;
    display: inline-block;
    animation: blink 1.5s infinite;
}

@keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.4; }
}

.chat-actions {
    display: flex;
    gap: 8px;
}

.chat-action-btn {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.15);
    border: none;
    color: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    transition: all 0.2s ease;
}

.chat-action-btn:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: scale(1.05);
}

/* ===================== CHAT MESSAGES ===================== */
.chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 20px 24px;
    background: #F8FAFC;
    display: flex;
    flex-direction: column;
    gap: 16px;

}

.chat-message {
    display: flex;
    gap: 12px;
    max-width: 85%;
    animation: slideIn 0.3s ease;
    /* width: 500px; */
}

@keyframes slideIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.chat-message.user {
    align-self: flex-end;
    flex-direction: row-reverse;
}

.chat-message.bot {
    align-self: flex-start;
}

.message-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.message-avatar.bot {
    background: linear-gradient(135deg, var(--primary) 0%, #764ba2 100%);
    color: #fff;
    font-size: 0.9rem;
}

.message-avatar.user {
    background: #E5E7EB;
    color: var(--text-secondary);
}

.message-content {
    padding: 14px 18px;
    border-radius: 18px;
    font-size: 0.95rem;
    line-height: 1.5;
    position: relative;
}

.chat-message.user .message-content {
    background: linear-gradient(135deg, var(--primary) 0%, #764ba2 100%);
    color: #fff;
    border-bottom-right-radius: 4px;
}

.chat-message.bot .message-content {
    background: #fff;
    color: var(--text-primary);
    border-bottom-left-radius: 4px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.message-time {
    font-size: 0.7rem;
    color: var(--text-light);
    margin-top: 6px;
    padding: 0 4px;
}

.chat-message.user .message-time {
    text-align: right;
    color: var(--text-light);
}

/* ===================== TYPING INDICATOR ===================== */
.typing-indicator {
    display: flex;
    gap: 4px;
    padding: 16px 18px;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    width: fit-content;
}

.typing-indicator span {
    width: 8px;
    height: 8px;
    background: var(--text-light);
    border-radius: 50%;
    animation: typing 1.4s infinite;
}

.typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
.typing-indicator span:nth-child(3) { animation-delay: 0.4s; }

@keyframes typing {
    0%, 60%, 100% { transform: translateY(0); }
    30% { transform: translateY(-8px); }
}

/* ===================== CHAT INPUT ===================== */
.chat-input-container {
    padding: 16px 24px 24px;
    background: #fff;
    border-top: 1px solid var(--border-color);
}

.chat-input-wrapper {
    display: flex;
    gap: 12px;
    align-items: flex-end;
}

.chat-input {
    flex: 1;
    padding: 14px 18px;
    border: 2px solid var(--border-color);
    border-radius: 14px;
    font-size: 0.95rem;
    font-family: inherit;
    resize: none;
    max-height: 120px;
    transition: all 0.2s ease;
    line-height: 1.5;
}

.chat-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

.chat-input::placeholder {
    color: var(--text-light);
}

.send-btn {
    width: 50px;
    height: 50px;
    border-radius: 14px;
    background: linear-gradient(135deg, var(--primary) 0%, #764ba2 100%);
    color: #fff;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
}

.send-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 16px rgba(79, 70, 229, 0.4);
}

.send-btn:active {
    transform: scale(0.95);
}

/* ===================== STUDENT TABLE IN CHAT ===================== */
.chat-sv-table-wrapper {
    margin-top: 14px;
    border-radius: 14px;
    overflow-x: hidden;
    overflow-y: auto;
    max-height: 420px;
    border: 1px solid #E2E8F0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}

.chat-sv-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
    font-family: 'Inter', 'Segoe UI', sans-serif;
}

.chat-sv-table thead tr {
    background: linear-gradient(135deg, var(--primary) 0%, #764ba2 100%);
    color: #fff;
}

.chat-sv-table th {
    padding: 9px 10px;
    text-align: left;
    font-weight: 600;
    white-space: nowrap;
    font-size: 11.5px;
    letter-spacing: 0.3px;
}

.chat-sv-table tbody tr {
    background: #fff;
    border-bottom: 1px solid #F1F5F9;
    transition: background 0.15s ease;
}

.chat-sv-table tbody tr:nth-child(even) {
    background: #F8FAFC;
}

.chat-sv-table tbody tr:hover {
    background: #EEF2FF;
}

.chat-sv-table td {
    padding: 8px 10px;
    color: var(--text-primary);
    vertical-align: middle;
}

.chat-sv-table .sv-name {
    font-weight: 600;
    color: #1E293B;
}

.chat-sv-table .sv-code {
    font-family: 'Courier New', monospace;
    font-size: 11px;
    color: #475569;
    background: #F1F5F9;
    padding: 2px 6px;
    border-radius: 4px;
}

.chat-sv-table .sv-status {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
}

.chat-sv-table .sv-status.active {
    background: #DCFCE7;
    color: #166534;
}

.chat-sv-table .sv-status.locked {
    background: #FEE2E2;
    color: #991B1B;
}

.chat-sv-table .sv-status::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
}

.chat-sv-table .sv-email {
    font-size: 11px;
    color: #64748B;
    max-width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.chat-sv-table .sv-faculty {
    font-size: 11.5px;
    color: #475569;
}

.chat-sv-table .sv-class {
    font-size: 11px;
    color: #64748B;
    background: #F8FAFC;
    padding: 2px 7px;
    border-radius: 4px;
    white-space: nowrap;
}

/* ===================== QUICK ACTIONS ===================== */
.quick-actions {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    padding: 12px 24px;
    background: #F8FAFC;
    border-top: 1px solid var(--border-color);
}

.quick-action-btn {
    padding: 8px 14px;
    background: #fff;
    border: 1px solid var(--border-color);
    border-radius: 20px;
    font-size: 0.8rem;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 6px;
}

.quick-action-btn:hover {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
}

/* ===================== WELCOME MESSAGE ===================== */
.welcome-bot {
    text-align: center;
    padding: 20px;
    background: linear-gradient(135deg, #F3F4F6 0%, #E5E7EB 100%);
    border-radius: 16px;
    margin-bottom: 16px;
}

.welcome-bot-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary) 0%, #764ba2 100%);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin: 0 auto 16px;
    box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
}

.welcome-bot h4 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 8px;
}

.welcome-bot p {
    font-size: 0.9rem;
    color: var(--text-secondary);
}

/* ===================== FOOTER ===================== */
.footer {
    background: linear-gradient(135deg, #1F2937 0%, #111827 100%);
    color: #fff;
    padding: 60px 0 0;
    margin-top: auto;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

.footer-grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr;
    gap: 48px;
    padding-bottom: 48px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-brand {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.footer-brand-logo {
    width: 70px;
    height: 70px;
    border-radius: 16px;
    object-fit: cover;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.footer-brand p {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.95rem;
    line-height: 1.7;
}

.footer-section h4 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: #fff;
    position: relative;
    padding-bottom: 10px;
}

.footer-section h4::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    border-radius: 2px;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 12px;
}

.footer-links a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    font-size: 0.95rem;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.footer-links a:hover {
    color: #fff;
    padding-left: 8px;
}

.footer-links a i {
    font-size: 0.75rem;
    color: var(--primary-light);
}

.footer-contact-item {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.95rem;
}

.footer-contact-item i {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-light);
    font-size: 0.9rem;
}

.footer-bottom {
    text-align: center;
    padding: 24px 0;
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.875rem;
}

/* ===================== RESPONSIVE ===================== */
@media (max-width: 1024px) {
    .menu-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
}

@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        text-align: center;
        gap: 16px;
    }

    .header-left {
        flex-direction: column;
    }

    .menu-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .menu-card {
        padding: 24px 16px;
    }

    .menu-card-icon {
        width: 64px;
        height: 64px;
        font-size: 1.8rem;
    }

    .footer-grid {
        grid-template-columns: 1fr;
        gap: 32px;
        text-align: center;
    }

    .footer-section h4::after {
        left: 50%;
        transform: translateX(-50%);
    }

    .footer-contact-item {
        justify-content: center;
    }

    .welcome-section h1 {
        font-size: 1.5rem;
    }

    .chat-container {
        width: 100%;
        right: 0;
        max-height: 85vh;
    }
}

@media (max-width: 480px) {
    .menu-grid {
        grid-template-columns: 1fr;
    }

    .main-content {
        padding: 32px 16px;
    }

    .chat-fab {
        bottom: 20px;
        right: 20px;
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
}

/* ===================== STICKY HEADER ===================== */
.sticky {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
}
</style>
</head>
<?php


if(!isset($_REQUEST['bm'])){
	echo header("refresh:0,url='index.php'");
}
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
$ma=$_REQUEST['bm'];
$sql="select * from user where user_code='$ma'";
$qr=mysql_query($sql);
$r=mysql_fetch_assoc($qr);
$ma=$r['user_code'];
$mk=$r['matkhau'];
$k=$_SESSION['mk'];
$m=$_SESSION['ma'];
if($k != $mk || $m != $ma){
	echo header("refresh:0,url='index.php'");
}
?>
<?php
// check dang nhap
if(!isset($_REQUEST['bm'])){
	echo header("refresh:0,url='index.php'");
}
include_once("Controller/cTKADHT.php");
$p=new cTKAD();
$b=$p->ktbm();
$c=mysql_fetch_assoc($b);
$c1=$c['user_code'];
$a=$_REQUEST['bm'];
if($a != $c1){
	echo header("refresh:0,url='index.php'");
}
?>

<body>
<!-- ===================== HEADER ===================== -->
<header class="header-main" id="codinh">
    <div class="header-content">
        <div class="header-left">
            <img src="./img/jahja.jpg" alt="Logo" class="header-logo"/>
            <div>
                <div class="header-title">Trang Admin Hệ Thống</div>
                <div class="header-subtitle">Quản trị viên</div>
            </div>
        </div>
        <div class="header-right">
            <div class="admin-badge">
                <i class="fas fa-user-shield"></i>
                <span>Quản trị hệ thống</span>
            </div>
        </div>
    </div>
</header>

<!-- ===================== MAIN CONTENT ===================== -->
<main class="main-content">
    <div class="welcome-section">
        <h1>Chào Mừng Đến Với Trang Quản Trị</h1>
        <p>Quản lý toàn bộ hệ thống một cách dễ dàng và hiệu quả</p>
        <div class="divider"></div>
    </div>

    <!-- ===================== MENU GRID ===================== -->
    <div class="menu-grid">
        <a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>" class="menu-card">
            <div class="menu-card-icon green">
                <i class="fas fa-cogs"></i>
            </div>
            <div class="menu-card-title">Quản Lý Chung</div>
            <div class="menu-card-desc">Cài đặt hệ thống</div>
        </a>

        <a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>" class="menu-card">
            <div class="menu-card-icon blue">
                <i class="fas fa-users"></i>
            </div>
            <div class="menu-card-title">Quản Lý Tài Khoản</div>
            <div class="menu-card-desc">Người dùng hệ thống</div>
        </a>

        <a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']; ?>" class="menu-card">
            <div class="menu-card-icon purple">
                <i class="fas fa-book-open"></i>
            </div>
            <div class="menu-card-title">Quản Lý Học Phần</div>
            <div class="menu-card-desc">Quản lý khóa học</div>
        </a>

        <a href="info2.php?user=<?php echo $_REQUEST['bm'] ?>" class="menu-card">
            <div class="menu-card-icon pink">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="menu-card-title">Thông Tin Admin</div>
            <div class="menu-card-desc">Hồ sơ cá nhân</div>
        </a>
    </div>
</main>

<!-- ===================== CHAT AI BUTTON ===================== -->
<button class="chat-fab" id="chatFab" onclick="openChat()">
    <span class="pulse-ring"></span>
    <i class="fas fa-comment-dots"></i>
</button>

<!-- ===================== CHAT OVERLAY ===================== -->
<div class="chat-overlay" id="chatOverlay" onclick="closeChat()"></div>

<!-- ===================== CHAT CONTAINER ===================== -->
<div class="chat-container" id="chatContainer">
    <!-- Chat Header -->
    <div class="chat-header">
        <div class="chat-header-info">
            <div class="chat-avatar">
                <i class="fas fa-robot"></i>
            </div>
            <div class="chat-header-text">
                <h3>AI Assistant</h3>
                <p><span class="chat-status"></span> Online - Sẵn sàng hỗ trợ</p>
            </div>
        </div>
        <div class="chat-actions">
            <button class="chat-action-btn" onclick="clearChat()" title="Xóa cuộc trò chuyện">
                <i class="fas fa-trash-alt"></i>
            </button>
            <button class="chat-action-btn" onclick="closeChat()" title="Đóng">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- Chat Messages -->
    <div class="chat-messages"  id="chatMessages">
        <!-- Welcome Message -->
        <div class="welcome-bot">
            <div class="welcome-bot-icon">
                <i class="fas fa-robot"></i>
            </div>
            <h4>Xin chào! Tôi là AI Assistant</h4>
            <p>Tôi có thể giúp gì cho bạn hôm nay?</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <button class="quick-action-btn" onclick="sendQuickMessage('Hướng dẫn tôi cách sử dụng hệ thống quản trị này')">
            <i class="fas fa-book"></i> Hướng dẫn
        </button>
        <button class="quick-action-btn" onclick="sendQuickMessage('Tôi muốn biết cách quản lý tài khoản sinh viên và giảng viên')">
            <i class="fas fa-user-cog"></i> Quản lý TK
        </button>
        <button class="quick-action-btn" onclick="sendQuickMessage('Chỉ cho tôi cách thêm và quản lý học phần mới')">
            <i class="fas fa-plus-circle"></i> Thêm HP
        </button>
        <button class="quick-action-btn" onclick="sendQuickMessage('Tôi cần hỗ trợ về vấn đề kỹ thuật')">
            <i class="fas fa-headset"></i> Hỗ trợ
        </button>
    </div>

    <!-- Chat Input -->
    <div class="chat-input-container">
        <div class="chat-input-wrapper">
            <textarea class="chat-input" id="chatInput" placeholder="Nhập tin nhắn..." rows="1" onkeydown="handleKeyDown(event)"></textarea>
            <button class="send-btn" onclick="sendMessage()">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

<!-- ===================== FOOTER ===================== -->
<footer class="footer">
    <div class="footer-content">
        <div class="footer-grid">
            <div class="footer-brand">
                <img src="./img/jahja.jpg" alt="Logo" class="footer-brand-logo"/>
                <p>Chào Mừng Các Bạn Đến Với Hệ Thống Quản Trị Thông Minh - Giải pháp quản lý toàn diện cho mọi nhu cầu.</p>
            </div>

            <div class="footer-section">
                <h4>Liên Kết Nhanh</h4>
                <ul class="footer-links">
                    <li><a href="quanlychung.php?bm=<?php echo $_REQUEST['bm']; ?>"><i class="fas fa-chevron-right"></i> Quản Lý Chung</a></li>
                    <li><a href="quanlytaikhoan.php?bm=<?php echo $_REQUEST['bm']; ?>"><i class="fas fa-chevron-right"></i> Quản Lý Tài Khoản</a></li>
                    <li><a href="quanlyhocphan.php?bm=<?php echo $_REQUEST['bm']; ?>"><i class="fas fa-chevron-right"></i> Quản Lý Học Phần</a></li>
                    <li><a href="info2.php?user=<?php echo $_REQUEST['bm'] ?>"><i class="fas fa-chevron-right"></i> Thông Tin Admin</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h4>Liên Hệ</h4>
                <div class="footer-contact-item">
                    <i class="fas fa-building"></i>
                    <span>Trung Tâm Quản Trị Hệ Thống - Trường...</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-phone"></i>
                    <span>0143.234.563</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>abc@gmail.com</span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2026 Hệ Thống Quản Trị. Tất cả quyền được bảo lưu.</p>
        </div>
    </div>
</footer>
</body>
</html>
<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("codinh");

var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}

// ===================== CHAT FUNCTIONS =====================
function openChat() {
    document.getElementById('chatOverlay').classList.add('active');
    document.getElementById('chatContainer').classList.add('active');
    document.getElementById('chatInput').focus();
}

function closeChat() {
    document.getElementById('chatOverlay').classList.remove('active');
    document.getElementById('chatContainer').classList.remove('active');
}

function clearChat() {
    const messagesContainer = document.getElementById('chatMessages');
    messagesContainer.innerHTML = `
        <div class="welcome-bot">
            <div class="welcome-bot-icon">
                <i class="fas fa-robot"></i>
            </div>
            <h4>Xin chào! Tôi là AI Assistant</h4>
            <p>Tôi có thể giúp gì cho bạn hôm nay?</p>
        </div>
    `;
}

function handleKeyDown(event) {
    if (event.key === 'Enter' && !event.shiftKey) {
        event.preventDefault();
        sendMessage();
    }
}

function sendMessage() {
    const input = document.getElementById('chatInput');
    const message = input.value.trim();
    
    if (message === '') return;
    
    addUserMessage(message);
    input.value = '';
    input.style.height = 'auto';
    
    // Show typing indicator
    showTypingIndicator();
    
    // Call API to chat-api.php
    fetch('chat-api.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ prompt: message })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('HTTP error! status: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        hideTypingIndicator();
        if (data.error) {
            addBotMessage(`<span style="color: #EF4444;"><i class="fas fa-exclamation-circle"></i> Lỗi: ${data.error}</span>`);
        } else {
            // data.response có thể là string hoặc array
            let responseText = data.response;
            if (Array.isArray(responseText)) {
                responseText = responseText.map(item => item.content || item).join('');
            }
            addBotMessage(responseText);
        }
    })
    .catch(error => {
        hideTypingIndicator();
        addBotMessage(`<span style="color: #EF4444;"><i class="fas fa-exclamation-circle"></i> Lỗi kết nối: ${error.message}</span><br><small>Vui lòng kiểm tra server AI đang chạy!</small>`);
        console.error('Chat API Error:', error);
    });
}

function addUserMessage(message) {
    const messagesContainer = document.getElementById('chatMessages');
    const time = new Date().toLocaleTimeString('vi-VN', { hour: '2-digit', minute: '2-digit' });
    
    const messageDiv = document.createElement('div');
    messageDiv.className = 'chat-message user';
    messageDiv.innerHTML = `
        <div class="message-avatar user">
            <i class="fas fa-user"></i>
        </div>
        <div class="message-content">
            ${escapeHtml(message)}
            <div class="message-time">${time}</div>
        </div>
    `;
    
    messagesContainer.appendChild(messageDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

function addBotMessage(message) {
    const messagesContainer = document.getElementById('chatMessages');
    const time = new Date().toLocaleTimeString('vi-VN', { hour: '2-digit', minute: '2-digit' });
    
    const messageDiv = document.createElement('div');
    messageDiv.className = 'chat-message bot';
    messageDiv.innerHTML = `
        <div class="message-avatar bot">
            <i class="fas fa-robot"></i>
        </div>
        <div class="message-content">
            ${message}
            <div class="message-time">${time}</div>
        </div>
    `;
    
    messagesContainer.appendChild(messageDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

function showTypingIndicator() {
    const messagesContainer = document.getElementById('chatMessages');
    const typingDiv = document.createElement('div');
    typingDiv.className = 'chat-message bot';
    typingDiv.id = 'typingIndicator';
    typingDiv.innerHTML = `
        <div class="message-avatar bot">
            <i class="fas fa-robot"></i>
        </div>
        <div class="typing-indicator">
            <span></span>
            <span></span>
            <span></span>
        </div>
    `;
    
    messagesContainer.appendChild(typingDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

function hideTypingIndicator() {
    const typing = document.getElementById('typingIndicator');
    if (typing) typing.remove();
}

function sendQuickMessage(message) {
    document.getElementById('chatInput').value = message;
    sendMessage();
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function getAIResponse(message) {
    const lowerMessage = message.toLowerCase();
    
    // Knowledge base responses
    const responses = {
        'hướng dẫn': `
            <strong>📖 Hướng Dẫn Sử Dụng Hệ Thống</strong><br><br>
            <strong>1. Quản Lý Chung:</strong> Cài đặt các thông tin cơ bản của hệ thống như Khoa/Viện, Chuyên ngành, Tin tức.<br><br>
            <strong>2. Quản Lý Tài Khoản:</strong> Quản lý tài khoản sinh viên và giảng viên. Có thể thêm, sửa, xóa và import từ file Excel.<br><br>
            <strong>3. Quản Lý Học Phần:</strong> Tạo và quản lý các môn học phần, lớp học phần, phân công giảng viên và sinh viên.<br><br>
            <strong>4. Thông Tin Admin:</strong> Xem và chỉnh sửa thông tin cá nhân của bạn.
        `,
        'quản lý tài khoản': `
            <strong>👥 Quản Lý Tài Khoản</strong><br><br>
            <strong>Sinh viên:</strong> Xem danh sách, thông tin chi tiết, chỉnh sửa và xóa tài khoản sinh viên.<br><br>
            <strong>Giảng viên:</strong> Quản lý thông tin giảng viên bao gồm họ tên, email, khoa và chuyên ngành.<br><br>
            <strong>Import Excel:</strong> Bạn có thể tải lên file Excel để thêm nhiều tài khoản cùng lúc. File mẫu có thể tải xuống từ nút "Tải mẫu".
        `,
        'thêm học phần': `
            <strong>📚 Thêm Học Phần Mới</strong><br><br>
            <strong>Bước 1:</strong> Vào "Quản Lý Học Phần" → "Môn Học Phần" → "Thêm Mới"<br><br>
            <strong>Bước 2:</strong> Tải lên file Excel theo mẫu có sẵn<br><br>
            <strong>Bước 3:</strong> Sau khi tạo môn học phần, vào "Lớp Học Phần" để tạo lớp<br><br>
            <strong>Bước 4:</strong> Phân công giảng viên và thêm sinh viên vào lớp học phần
        `,
        'hỗ trợ': `
            <strong>📞 Liên Hệ Hỗ Trợ</strong><br><br>
            <strong>Phone:</strong> 0143.234.563 - ext 808<br><br>
            <strong>Email:</strong> csm@gmail.com<br><br>
            <strong>Giờ làm việc:</strong> Thứ 2 - Thứ 6, 8:00 - 17:00<br><br>
            Nếu bạn gặp vấn đề khẩn cấp, vui lòng liên hệ trực tiếp với bộ phận IT.
        `,
        'xin chào': `Xin chào! 👋 Tôi có thể giúp gì cho bạn hôm nay?`,
        'cảm ơn': `Không có gì! 😊 Nếu bạn cần thêm hỗ trợ, đừng ngần ngại hỏi tôi nhé!`,
        'tạm biệt': `Tạm biệt! 👋 Chúc bạn một ngày làm việc hiệu quả!`,
        'default': `
            Cảm ơn bạn đã hỏi! 🤔<br><br>
            Tôi có thể giúp bạn về:<br>
            • <strong>Hướng dẫn sử dụng</strong> hệ thống<br>
            • <strong>Quản lý tài khoản</strong> sinh viên và giảng viên<br>
            • <strong>Thêm học phần</strong> mới<br>
            • <strong>Liên hệ hỗ trợ</strong><br><br>
            Bạn có thể nhấn vào các nút bên dưới để được hướng dẫn cụ thể hơn!
        `
    };
    
    // Check for matching responses
    if (lowerMessage.includes('hướng dẫn') || lowerMessage.includes('sử dụng')) {
        return responses['hướng dẫn'];
    } else if (lowerMessage.includes('tài khoản') || lowerMessage.includes('quản lý tk')) {
        return responses['quản lý tài khoản'];
    } else if (lowerMessage.includes('thêm') && (lowerMessage.includes('học phần') || lowerMessage.includes('hp'))) {
        return responses['thêm học phần'];
    } else if (lowerMessage.includes('hỗ trợ') || lowerMessage.includes('liên hệ') || lowerMessage.includes('help')) {
        return responses['hỗ trợ'];
    } else if (lowerMessage.includes('chào') || lowerMessage.includes('hi')) {
        return responses['xin chào'];
    } else if (lowerMessage.includes('cảm ơn') || lowerMessage.includes('thanks')) {
        return responses['cảm ơn'];
    } else if (lowerMessage.includes('tạm biệt') || lowerMessage.includes('bye')) {
        return responses['tạm biệt'];
    } else {
        return responses['default'];
    }
}

// Auto-resize textarea
document.getElementById('chatInput').addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = Math.min(this.scrollHeight, 120) + 'px';
});
</script>
